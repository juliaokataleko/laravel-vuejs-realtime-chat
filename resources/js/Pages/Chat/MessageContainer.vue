<template>
    <div style="" class=" w-full">
       <div class=" p-2 flex flex-col-reverse">
           <div v-for="(message, index) in messages" :key="index">
               <message-item :message="message" />
           </div>
       </div>
    </div>
</template>

<script>
import messageItem from './messageItem.vue'
    export default {
  components: { messageItem },
        props: ['messages']
    }
</script>