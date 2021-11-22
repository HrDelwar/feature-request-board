<template>
  <div class="wpfrb-board-lists">
        <div class="wpfrb-board-lists-inner">
            <table class="ffb-featured-list-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <th>Title</th>
                        <th>Shortcode</th>
                        <th>Sort By</th>
                        <th>Visibility</th>
                    </tr>
                </thead>
                <tbody v-if="allBoardLists.length">
                    <FeatureBoardListItem v-for="list in allBoardLists" :key="list.id" :item="list" @delete="deleteTableRow(list.id)" />
                </tbody>
            </table>
        </div>
        <p class="ffb-features-total-row">({{allBoardLists.length}}) Rows</p>
    </div>
</template>

<script>
import {reactive, toRefs, onMounted} from 'vue'
import FeatureBoardListItem from './FeatureBoardListItem.vue'
export default {
    name:'FeatureBoardLists',
    components:{
        FeatureBoardListItem
    },
    setup(){
        const state = reactive({
            allBoardLists:[],
            isDeleteModal:false,
            currentId:'',
            error:''
        })

        function deleteTableRow(id) {
            state.isDeleteModal = true;
            state.currentId = id;
        }
        function cancelDeleteTableRow() {
            state.isDeleteModal = false;
        }
        onMounted(() => {
            $.ajax({
                type: "POST",
                url: ajax_obj.ajaxurl,
                dataType: 'json',
                data: {
                    action: "wpfrb_get_all_feature_board",
                    nonce:ajax_obj.nonce
                },
                success(res) {
                    if (res.success) {
                        state.error = ''
                        state.allBoardLists = res.data
                    }else{
                        state.error = req.message
                    }
                    },
                error({responseJSON: {data}}, _, err) {
                    state.error = data;
                }
            });
        })
        return{
            ...toRefs(state),
            deleteTableRow,
            cancelDeleteTableRow,
        }

    }

}
</script>

<style scoped>
    .wpfrb-board-lists {
        margin-top: 30px;
        background: #fff;
        border-radius: 4px;
        padding: 10px 15px;
    }
    .wpfrb-board-lists .wpfrb-board-lists-inner {
        max-height: 650px;
        overflow-x: hidden;
    }
    .wpfrb-board-lists table {
        width: 100%;
        text-align: left;
        border-spacing: 0;
    }
    .wpfrb-board-lists::-webkit-scrollbar {
        width: 6px;
        border-radius: 30px;
    }
    .wpfrb-board-lists::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 30px;
    }
    .wpfrb-board-lists .ffb-features-total-row {
        text-align: right;
        font-weight: 400;
        margin: 15px 0 5px 0;
    }
</style>