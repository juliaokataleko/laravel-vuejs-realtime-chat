<template>
    <div class="grid grid-cols-2">
        <div class="">
            {{ selected.name }} 
        </div>
        <div>
            <select style="padding: 2px; width: 100%" 
            v-model="selected"
            @change="$emit('chatchanged', selected)"
            class="float-right"
            >
            <option v-for="(chat, index) in chats" :key="index"
            :value="chat">{{ chat.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['chats', 'currentChat'],
        data: function() {
            return {
                selected: ''
            }
        },
        created() {
            this.selected = this.currentChat
        },
        methods: {
            changeChat() {
                
            }
        }
    }
</script>