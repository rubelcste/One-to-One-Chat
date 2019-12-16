<template>
  <div class="container-chat clearfix">
    <div class="people-list" id="people-list">
      <div class="search">
        <input type="text" placeholder="search" />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
        <li @click.prevent="selectUser(user.id)" class="clearfix" v-for="user in userList" :key="user.id">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
          <div class="about">
            <div class="name">{{user.name}}</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="chat">
      <div class="chat-header clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />
        <div class="chat-about">
          <div v-if="userMessage.user" class="chat-with float-left">{{userMessage.user.name}}</div>
          <div class="dropdown d-inline float-right">
            <span class="dropdown-toggle" id="dropId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             &nbsp;&nbsp;&nbsp;...</span>
            <div class="dropdown-menu" aria-labelledby="dropId">
              <a class="dropdown-item text-danger" href="#">Delete All Message</a>
            </div>
          </div>
        </div>
        <i class="fa fa-star"></i>
        </div> <!-- end chat-header -->
        <div class="chat-history" v-chat-scroll>
          <ul>
            <li class="clearfix" v-for="message in userMessage.messages" :key="message.id">
              <div class="message-data align-right">
                <span class="message-data-time" >{{message.created_at | timeformat}}</span> &nbsp; &nbsp;
                <span class="message-data-name" >{{message.user.name}}</span>
                <div class="dropdown d-inline">
                  <span class="dropdown-toggle" id="dropId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </span>
                  <div class="dropdown-menu" aria-labelledby="dropId">
                    <a @click.prevent="deleteMessage(message.id)" class="dropdown-item text-danger" href="#">Delete Message</a>
                  </div>
                </div>
              </div>
              <div :class="`message   ${message.user.id==userMessage.user.id ? 'my-message' : 'other-message float-left'}`">
                {{message.message}}
              </div>
            </li>
        </ul>
      </div>

      <div class="chat-message clearfix">
        <textarea @keypress.enter="sendMessage" v-model="message" name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>

        <a class="ml-3" href=""></a><i class="fa fa-file"></i>
        <a class="ml-3" href=""></a><i class="fa fa-file-image-o"></i>

        <button @click.prevent="sendMessage">Send</button>

      </div> <!-- end chat-message -->

    </div> <!-- end chat -->

  </div> <!-- end container -->
</template>

<script>
export default {
  mounted(){
    this.$store.dispatch('userList');
  },
  data(){
    return{
      message:[],
    }
  },
  computed:{
    userList(){
    return  this.$store.getters.userList
    },
    userMessage(){
    return  this.$store.getters.userMessage
    }
  },
  created(){
  },
  methods:{
    selectUser(userId){
      return  this.$store.dispatch('userMessage',userId);
    },
    sendMessage(e){
      e.preventDefault();
      if(this.message!=''){
      axios.post('/sendmessage', {message:this.message, user_id:this.userMessage.user.id})
      .then(response=>{
        this.selectUser(this.userMessage.user.id);
        });
      this.message =''
      }
    },
    deleteMessage(messageId){
      // axios.get(`/deletemessage/${messageId}`)
      // .then(response=>{
      //   this.selectUser(this.userMessage.user.id);
      // });
      axios.get(`/deletemessage/${messageId}`)
      .then(response=>{
        this.selectUser(this.userMessage.user.id);
      });
    }
  }
}
</script>

<style>
</style>