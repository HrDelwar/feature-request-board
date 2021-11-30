<template>
  <tr class="frb-board-list-row">
        <th>
            <div class="frb-board-id">{{item.id}}</div>
        </th>
        <td>
            <h1><a href="#">{{item.title}}</a></h1>
            <div class="actions">
                <a href="#" class="edit-column">Edit</a> | 
                <a href="#" @click="deleteHandle" class="delete-column">Delete</a>
            </div>
        </td>
        <td style="position:relative;">
            <input ref="frb_copy_ref" id="frb-shortcode" @mouseenter="hoverShoutcode=!hoverShoutcode" @mouseleave="hoverShoutcode=!hoverShoutcode" :value="'[wpfrb-board id=\''+item.id+'\']'"  @click="copyURL" readonly>
            <p v-if="hoverShoutcode" class="tooltip">{{copyTooltip}}</p>
        </td>
        <td>
            <div class="ffb-sort-by">
                <span>{{item.sort_by}}</span>
            </div>
        </td>
        <td>
            <div class="ffb-visibility">
                <span>{{item.visibility}}</span>
            </div>
        </td>
    </tr>
</template>

<script>
import {reactive,ref, toRefs, toRef} from 'vue'
export default {
    name:'FeatureBoardListItem',
    props:['item'],
    setup(props, ctx){

        const {item} = toRefs(props)
        const state = reactive({
            copyTooltip: 'Click to Copy Shortcode',
            frb_copy_ref:null,
            item,
            hoverShoutcode:false
        })

        console.log({item:item.value})
        function deleteHandle() {
            ctx.emit('delete')
        }

        function copyURL() {
            var Url = state.frb_copy_ref;
            Url.select();
            document.execCommand("copy");
            state.copyTooltip = 'Copied Shortcode';
            setTimeout(() => {
                state.copyTooltip = 'Click to Copy Shortcode';
            }, 1500)
        }
        return{
            ...toRefs(state),
            deleteHandle,
            copyURL
        }
    }
}
</script>

<style >
    .frb-board-list-row h1 {
        color: #000;
        font-size: 16px;
        font-weight: 400;
        padding: 0;
        margin: 0 0 2px 0;
        display: inline-block;
    }
   
    .frb-board-list-row h1 a {
        color: #000;
        text-decoration: none;
    }
    .frb-board-list-row h1 a:hover {
        color: #2771b1;
    }
    .frb-board-list-row .actions {
        opacity: 0;
        visibility: hidden;
    }
    .frb-board-list-row .actions .delete-column {
        color: red;
    }
    .wpfrb-board-lists table tbody > tr:hover .actions {
        opacity: 1;
        visibility: visible;
    }
    .wpfrb-board-lists table tbody th,
    .wpfrb-board-lists table tbody td {
        border-bottom: 1px solid #f3f3f3;
        padding: 8px 0 8px 8px;
        transition: .3s;
    }
    .wpfrb-board-lists table tbody th {
        vertical-align: top;
    }
    .wpfrb-board-lists table tbody tr:hover th,
    .wpfrb-board-lists table tbody tr:hover td {
        background: #f6f9ff;
    }
    .ffb-featured-list-table thead tr th, .ffb-featured-list-table thead tr td {
        border-bottom: 1px solid #eee;
        padding: 8px 0 8px 8px;
        color: #fff;
        border: none;
        border-width: 0;
    }
    .ffb-featured-list-table thead {
         background: linear-gradient(90deg, #636164, #373e28);
    }
    .wpfrb-board-lists table tbody td #frb-shortcode {
        border: none;
        background: #eee;
        padding: 5px 5px 6px 7px;
        display: inline-block;
        cursor: context-menu;
        font-weight: 400;
        font-size: 13px;
        width: 210px;
        text-align: center;
        margin: 0;
        border-radius: 2px;
    }
    .wpfrb-board-lists table tbody td #frb-shortcode:focus {
        outline: none;
        box-shadow: none;
    }

    /* Tooltip */
    .tooltip {
	position: absolute;
	top: -26px;
	left: 33px;
	background: gray;
	color: white;
	border-radius: 5px;
	padding: 2px 5px;
	z-index: 1030;
    }
</style>