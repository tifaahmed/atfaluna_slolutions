<template>
	<div>
		<router-view></router-view>
	</div>
</template>

<script>

    export default {
        mounted() {
            console.log( 'main layout' );
        },
    }
</script>