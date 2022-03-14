<template>
    <div style="margin: 10px; padding: 5px; border: 1px #ddd solid; border-radius: 4px">
        <b>{{ message.user.name }}:</b> {{ message.message }}
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>