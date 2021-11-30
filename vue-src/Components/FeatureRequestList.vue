<template>
    <div>
        <Header   :title="'Feature Requests (' + lists.length + ')'"/>
        <div class="wpfrb-requests-lists">
            <div class="wpfrb-requests-list-sort-option">
                Sort by
                <select @change="sortRequestsCallback" name="wpfrb-requests-list-sort" id="wpfrb-requests-list-sort" v-model="sortRequestsList">
                    <option value="all">All</option>
                    <option v-for="item in boards" :key="item.id" :value="item.id">
                        {{item.title}}
                    </option>
                </select>
                Board(s)
            </div>
            <div class="wpfrb-requests-lists-inner">
                <table class="wpfrb-request-list-table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <p v-if="lists.length == 0">No Request Found!</p>
                        <template  v-if="lists.length">
                            <FeatureRequestListItem  :item="list" v-for="list in lists" :key="list.id" />
                        </template>
                    </tbody>
                </table>
                
            </div>
            <p class="wpfrb-requests-total-rows">({{ lists.length}}) Row</p>
        </div>
    </div>
</template>

<script>
import {reactive, toRefs, onMounted} from 'vue'
import Header from '../Layout/Header'
import FeatureRequestListItem from './FeatureRequestListItem'

export default {
    name:'FeatureRequestList',
    components:{
        Header,
        FeatureRequestListItem
    },
    setup(){
        const state = reactive({
            lists: [],
            boards: [],
            sortRequestsList: 'all',
        })

        function sortRequestsCallback() {
            $.ajax({
                type: 'POST',
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: 'wpfrb_all_request_by_board_id',
                    nonce:ajax_obj.nonce,
                    board_id: state.sortRequestsList
                },
                success: function(res) {
                    if(res.success){
                        state.lists = res.data
                    }else{
                        state.lists = []
                    }
                }
            })
        }

        onMounted(() => {
            $.ajax({
                type: "POST",
                url: ajax_obj.ajaxurl,
                dataType: 'json',
                data: {
                    action: "wpfrb_get_all_feature_list",
                    nonce:ajax_obj.nonce
                },
                success(res) {
                    if (res.success) {
                        state.error = ''
                        state.lists = res.data
                    }else{
                        state.error = req.message
                    }
                    },
                error({responseJSON: {data}}, _, err) {
                    state.error = data;
                }
            });

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
                        state.boards = res.data
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
           sortRequestsCallback
        }

    }

}
</script>

<style>
    .wpfrb-requests-lists {
        margin-top: 30px;
        background: #fff;
        border-radius: 4px;
        padding: 10px 15px;
    }
    .wpfrb-requests-list-sort-option {
        margin-bottom: 10px;
        font-size: 14px;
        color: #828897;
    }
    .wpfrb-requests-list-sort-option select {
        border: 1px solid #eee;
        border-radius: 4px;
        padding: 2px 25px 2px 15px;
        color: #828897;
        transition: .3s;
        -webkit-transition: .3s;
        -ms-transition: .3s;
        -moz-transition: .3s;
        -o-transition: .3s;
    }
    .wpfrb-requests-list-sort-option select:hover,
    .wpfrb-requests-list-sort-option select:focus {
        outline: none;
        box-shadow: none;
        border: 1px solid #fdd81070;
    }
    .wpfrb-requests-lists .wpfrb-requests-lists-inner {
        max-height: 650px;
        overflow-x: hidden;
    }
    .wpfrb-requests-lists table {
        width: 100%;
        text-align: left;
        border-spacing: 0;
    }
    .wpfrb-requests-lists::-webkit-scrollbar {
        width: 6px;
        border-radius: 30px;
    }
    .wpfrb-requests-lists::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 30px;
    }
    .wpfrb-requests-lists .wpfrb-requests-total-rows {
        text-align: right;
        font-weight: 400;
        margin: 15px 0 5px 0;
    }
</style>