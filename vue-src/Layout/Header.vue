<template>
<div class="">
  <h1>{{title}}</h1>
</div>

</template>

<script>
export default {
    props:['title']
}
</script>

<style scoped>
 h1 {
	background: white;
	padding: 10px 15px;
	color: gray;
	margin-right: 15px;
}
</style>