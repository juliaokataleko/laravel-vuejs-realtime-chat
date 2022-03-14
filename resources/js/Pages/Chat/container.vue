<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="">
                <chat-selection 
                v-if="currentChat.id"
                :chats="chats"
                :currentChat="currentChat"
                v-on:chatchanged="setChat($event)"
                />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="messages" />
                    <input-message 
                    :chat="currentChat" 
                    v-on:messagesent="getMessages()"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import MessageContainer from './MessageContainer.vue'
    import InputMessage from './inputMessage.vue'
import axios from 'axios'
import ChatSelection from './chatSelection.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            MessageContainer,
            InputMessage,
                ChatSelection
        },
        data: function() {
            return {
                chats: [],
                currentChat: [],
                messages: []
            }            
        },
        watch: {
            currentChat(val, oldVal) {
                if(oldVal.id) {
                    this.disconnect(oldVal)
                }
                
                this.connect();
            }
        },
        methods: {
            connect() {
                if(this.currentChat.id) {
                    var vm = this;
                    this.getMessages();

                    Echo.private("chat."+this.currentChat.id)
                    .listen('NewChatMessage', (e) => {
                        // alert("Ouvindo...")
                        console.log(e);
                        vm.getMessages();
                    }) 

                }
            },
            disconnect(chat) {
                Echo.leave("chat." + chat.id);
            },
            getChats() {
                axios.get('/chats').then(res => {
                    this.chats = res.data;
                    this.setChat(res.data[0]);
                })
                .catch((err) => {
                    console.log(err);
                })
            },
            setChat(chat) {
                this.currentChat = chat;
                this.getMessages();
            },
            getMessages() {
                axios.get('chats/' + this.currentChat.id + '/messages')
                .then((res) => {
                    console.log(res);
                    this.messages = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                })
            }
        },
        created() {
            this.getChats();
        }
    })
</script>
