<template>
<div class="wpfrb-feature-board-form-modal" @click.self="hideFormModalhandle">
        <div :class=" isLoading ? 'adding-frb wpfrb-feature-board-form-modal-content' : 'wpfrb-feature-board-form-modal-content'">
            <span @click="hideFormModalhandle" class="close-frb-add-new-modal">+</span>
            <div v-show="isLoading || isDone" :class="isDone ? 'added-frb form-loader' : 'form-loader'">
                <span></span>
                <h2 v-if="isDone" class="frb-form-added">Done</h2>
                <a v-if="isDone" href="" class="done-btn">OK</a>
            </div>
            <h1>Add New Feature Board</h1>
               <p class="field-error" v-if="error.nonce">{{error.nonce}}</p>
            <form :class="isDone ? 'hidden-form': ''" @submit.prevent="formSubmited">
                <div class="input-group">
                    <label for="feature-title">
                        Title
                    </label>
                    <input type="text" id="feature-title"  v-model="title">
                    <p class="field-error" v-if="error.title">{{error.title}}</p>
                </div>
                <div class="input-group">
                    <label for="logourl">
                        Logo
                    </label>
                    <div class="logowrap">
                        <div v-if="previewLogo" class="logo-preview">
                            <img :src="previewLogo" class="logo" alt="">
                            <span class="remove-preview-logo" @click="removePreviewLogo">
                                +
                            </span>
                        </div>
                        <span @click="selectLogo">
                            {{previewLogo ? 'Change Logo' : 'Upload Logo'}}
                        </span>
                        <input ref="logourl" class="logourlinput" type="file" @input="pickLogo">
                    </div>
                </div>
                <div class="input-group">
                    <label for="sort_by">
                        Sort requests by
                    </label>
                    <select name="sort_by" id="sort_by" v-model="sort_by">
                        <option value="alphabetical">Alphabetical</option>
                        <option value="random">Random</option>
                        <option value="upvotes">Number of Upvotes</option>
                        <option value="comments">Number of Comments</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="visibility">
                        Visibility
                    </label>
                    <select name="visibility" id="visibility" v-model="visibility">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                    <p class="field-error" v-if="error.visibility">{{error.visibility}}</p>
                </div>
                <div class="input-group">
                    <button class="frb-addnewfeature-submit">
                        Add Feature Board
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
import {reactive, toRefs} from 'vue'
export default {
    name:'AddBoardForm',
    setup(props, ctx){
        const state  = reactive({
            title: '',
            isDone: false,
            isLoading: false,
            sort_by: 'alphabetical',
            visibility: 'public',
            previewLogo: null,
            logourl:null,
            error:{}
        })
        function selectLogo () {
          state.logourl.click()
        }
        function pickLogo () {
            let input = state.logourl
            let file = input.files
            if (file && file[0]) {
                let reader = new FileReader
                reader.onload = e => {
                    state.previewLogo = e.target.result
                }
                reader.readAsDataURL(file[0])
                ctx.emit('input', file[0])
            }
        }
        function removePreviewLogo() {
            state.previewLogo = null
        }

        function formSubmited() {
            state.isLoading = true;
            setTimeout(() => {
                $.ajax({
                    type: "POST",
                    url: ajax_url.ajaxurl,
                    dataType: 'json',
                    data: {
                        action: "wpfrb_create_feature_board",
                        title: state.title,
                        sort_by: state.sort_by,
                        visibility: state.visibility,
                        logo: state.previewLogo,
                        nonce:ajax_obj.nonce
                    },
                    success(res) {
                        if (res.success) {
                            state.error = {}
                            state.title = '';
                            state.isDone = true
                        }else{
                            state.error = {nonce: req.message}
                        }
                     },
                    error({responseJSON: {data}}, _, err) {
                        state.error = data;
                    }
                });
                state.isLoading = false;
            },1000);
        }
        function hideFormModalhandle() {
            ctx.emit('hideFormModal')
        }

        return {
            ...toRefs(state),
            selectLogo,
            formSubmited,
            hideFormModalhandle,
            pickLogo,
            removePreviewLogo,
            hideFormModalhandle
        }
    }
}
</script>

<style lang="css">
    .logowrap .logo-preview {
        width: 100px;
        height: 100px;
        position: relative;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .logowrap .logo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
    .logowrap .logo-preview .remove-preview-logo {
        position: absolute;
        right: -5px;
        top: -5px;
        display: inline-block;
        width: 15px;
        height: 15px;
        line-height: 13px;
        text-align: center;
        border-radius: 50%;
        background: #878787;
        color: #fff;
        transform: rotate(45deg);
        cursor: pointer;
        box-shadow: 0 0 0 2px #fff;
        transition: .3s;
    }
    .logowrap .logo-preview .remove-preview-logo:hover {
        background: #ff0000;
    }
    .wpfrb-feature-board-form-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        background: rgba(0,0,0,0.5);
        z-index: 99;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content {
        background: #fff;
        margin-top: 70px;
        border-radius: 4px;
        width: 100%;
        max-width: 500px;
        padding: 20px 30px 30px 30px;
        position: relative;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content h1 {
        padding: 0;
        font-size: 22px;
        margin-bottom: 20px;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group + .input-group {
        margin-top: 15px;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group select,
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group textarea,
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group input {
        display: block;
        width: 100%;
        border: 1px solid #eee;
        padding: 3px 13px;
        max-width: 100%;
        min-height: auto;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group select:focus,
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group textarea:focus,
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group input:focus {
        outline: none;
        border-color: #2771b1;
        box-shadow: none;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group label {
        font-weight: 400;
        margin-bottom: 5px;
        display: inline-block;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group .frb-addnewfeature-submit {
        background: #2771b1;
        border: none;
        color: #fff;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .description {
        font-weight: 300;
        display: block;
        color: #aaa;
        font-size: 12px;
        font-style: italic;
        margin: 3px 0 0 0;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group .logourlinput {
        width: 0;
        height: 0;
        opacity: 0;
        padding: 0;
        margin: 0;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .description strong {
        color: #000;
    }
    .form-loader {
        position: absolute;
        background: rgb(255 255 255 / 80%);
        z-index: 99;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .added-frb.form-loader {
        background: #fff;
    }
    .form-loader span {
        display: inline-block;
        width: 80px;
        height: 80px;
        border: 3px solid #eee;
        border-radius: 100%;
        border-top: 2px solid #2771b1;
        position: relative;
        transition: .3s;
    }
    .added-frb.form-loader span {
        border-color: #2771b1;
    }
    .adding-frb .form-loader span {
        animation: rotating 1s infinite linear;
    }
    .form-loader h2 {
        margin: 15px 0 15px 0;
        font-size: 20px;
    }
    .form-loader span:before {
        content: '';
        width: 16px;
        height: 35px;
        border-bottom: 2px solid #2771b1;
        position: absolute;
        border-right: 2px solid #2771b1;
        transform: rotate(45deg) scale(0);
        left: 33px;
        top: 16px;
        transition: .3s;
    }
    .added-frb.form-loader span:before {
        transform: rotate(45deg) scale(1);
    }
    .form-loader .done-btn {
        background: #2771b1;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        padding: 5px 13px;
        display: inline-block;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .tags {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 8px;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .tags span {
        background: #eee;
        border-radius: 30px;
        margin-right: 5px;
        padding: 1px 8px 3px 8px;
        display: inline-block;
        cursor: pointer;
        transition: .2s;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .tags span:hover {
        opacity: 0.5;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content .close-frb-add-new-modal {
        position: absolute;
        right: -10px;
        top: -10px;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        background: #fff;
        border-radius: 50%;
        transform: rotate(45deg);
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 0 20px rgb(0 0 0 / 15%);
        z-index: 999;
    }
    .wpfrb-feature-board-form-modal .wpfrb-feature-board-form-modal-content form .input-group .logowrap > span {
        width: 100%;
        display: block;
        border: 1px solid #eee;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        background: #f1f1f1;
        text-align: center;
    }

    .field-error{
        color: #ff0000;    
    }

    @keyframes rotating {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>