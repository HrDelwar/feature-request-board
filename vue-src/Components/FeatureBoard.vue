<template>
<div class="">
  <Header   title="Feature Boards"/>
  <el-button type="primary" @click="showFormModal">Add Board</el-button>
  <AddBoardForm v-if="isAddnewModal" @hideFormModal="hideFormModal"/>
  <FeatureBoardLists/>
</div>
  
</template>

<script>
import Header from '../Layout/Header'
import AddBoardForm from './AddBoardForm.vue'
import FeatureBoardLists from './FeatureBoardLists.vue'
import {ref} from 'vue'
export default {
 name:'FeatureBoard',
 components:{
   Header,
   AddBoardForm,
   FeatureBoardLists
 },
 setup(){
   const isAddnewModal = ref(false)
   function showFormModal() {
      isAddnewModal.value = true
    }
    function hideFormModal() {
      isAddnewModal.value = false;
    }
   return{
    isAddnewModal,
    hideFormModal,
    showFormModal
   }
 }
}
</script>

<style scoped>

</style>