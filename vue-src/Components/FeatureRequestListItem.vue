<template>
    <tr class="wpfrb-request-list">
        <th>
            <div class="wpfrb-id">{{item.id}}</div>
        </th>
        <td>
            <h1>
                {{item.title}}
            </h1>
            <div class="actions">
                <a @click.prevent="" href="#" class="edit-column">Edit</a> | 
                <a @click.prevent="" href="#" class="delete-column">Delete</a>
            </div>
        </td>
        <td>
            <p>
                {{item.description.substr(0, 40)}}
            </p>
        </td>
        <td>
            <div class="wpfrb-tags">
                <span>{{item.status}}</span>
            </div>
        </td>
    </tr>
</template>

<script>

export default {
    name:'FeatureRequestListItem',
    props: ['item'],
}
</script>

<style>
    .wpfrb-request-list h1 {
        color: #000;
        font-size: 16px;
        font-weight: 400;
        padding: 0;
        margin: 0 0 2px 0;
        display: inline-block;
    }
    .wpfrb-request-list-table .actions {
        opacity: 0;
        visibility: hidden;
    }
    .wpfrb-request-list-table .actions .delete-column {
        color: red;
    }
    .wpfrb-request-list-table tbody > tr:hover .actions {
        opacity: 1;
        visibility: visible;
    }
    .wpfrb-request-list-table tbody th,
    .wpfrb-request-list-table tbody td {
        border-bottom: 1px solid #f3f3f3;
        padding: 8px 0 8px 8px;
        transition: .3s;
    }
    .wpfrb-request-list-table tbody th {
        vertical-align: top;
    }
    .wpfrb-request-list-table tbody th .wpfrb-id {
        padding-top: 3px;
    }
    .wpfrb-request-list-table tbody tr:hover th,
    .wpfrb-request-list-table tbody tr:hover td {
        background: #f6f9ff;
    }
    .wpfrb-request-list-table thead tr th, .wpfrb-request-list-table thead tr td {
        border-bottom: 1px solid #eee;
        padding: 8px 0 8px 8px;
        color: #fff;
        border: none;
        border-width: 0;
    }
    .wpfrb-request-list-table thead {
        background: linear-gradient(90deg, #636164, #373e28);
    }
    .wpfrb-request-list-table tbody td #ffr-shortcode {
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
    .wpfrb-request-list-table tbody td #ffr-shortcode:focus {
        outline: none;
        box-shadow: none;
    }

    /* Tooltip */
    .tooltip {
        z-index: 10000;
        top: -8px !important;
    }
    .tooltip .tooltip-inner {
        background: #555;
        color: #fff;
        border-radius: 4px;
        padding: 6px 10px;
        font-size: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .tooltip .tooltip-arrow  {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #555;
        transform: rotate(45deg);
        left: 50%;
        bottom: -5px;
        margin-left: -5px;
    }
    
</style>