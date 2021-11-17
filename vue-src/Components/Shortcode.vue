<template>
  <div class="">
    <h1>Short Code</h1>

    <div class="">
      <h2>Register Form</h2>

      <div class="shortcode-wraper">
        <p class="short-code" id="wpfrb-feature-request-board" title="Click for copy code"
           @click="copyShotCode('#wpfrb-feature-request-board')">
          [wpfrb-feature-request-board]
        </p>
        <button class="copy-btn" @click="copyShotCode('#wpfrb-feature-request-board')">copy</button>
      </div>
    </div>
  </div>

  <div class="">
    <h1>Element</h1>
    <el-button type="primary">Primary</el-button>
  </div>
</template>

<script>
import { ElMessage } from 'element-plus'

export default {
  name: "Shortcode",
  setup() {

    function copyShotCode(element) {
      let $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      $temp.remove();
      ElMessage({
        message: 'Copied! ' + $(element).text(),
        type: 'success',
        center:true,
      })
    }

    return {
      copyShotCode
    }
  }
}
</script>

<style scoped>
h1 {
  color: gray;
  font-size: 30px;
  text-align: center;
  text-transform: capitalize;
}

.short-code.copied {
  background: #2ab2c8;
  color: black;
}

.shortcode-wraper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background: #dbd4d4;
  border-radius: 5px;
  color: #2ab2c8;
  box-shadow: inset 1px 1px 8px #7e8286;
}

.short-code {
  padding: 6px;
  border-radius: 4px;
  box-shadow: 0px 0px 1px;
}

.copy-btn {
  background: goldenrod;
  border: 0;
  border-radius: 4px;
  padding: 7px 10px;
  font-size: 16px;
  text-transform: uppercase;
  max-height: 33px;
  color: white;
  box-shadow: 0 0 2px #dddfd6;
  cursor: pointer;
}

</style>