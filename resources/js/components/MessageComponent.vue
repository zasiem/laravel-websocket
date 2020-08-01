<template>
  <div>
    <div class="card-body" style="height:65vh; overflow-y:scroll" id="chat">
      <ul>
        <li v-for="message in messages">{{ message.sender.name }} : {{ message.message }}</li>
      </ul>
    </div>
    <div class="card-footer">
      <input
        @keyup.enter="sendMessage"
        v-model="newMessage"
        type="text"
        class="form-control"
        name="message"
        id="inputMessage"
        placeholder="Masukan pesan"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: ["receiver", "sender"],

  data() {
    return {
      messages: [],
      newMessage: "",
    };
  },

  created() {
    this.fetchMessage();
  },

  methods: {
    fetchMessage() {
      let url = "/chat/" + this.receiver + "/fetch";
      axios.get(url).then((response) => {
        this.messages = response.data;
      });
    },

    sendMessage() {
      let url = "/chat/" + this.receiver + "/send";
      axios.post(url, { message: this.newMessage }).then((response) => {
        this.newMessage = response.data;
        this.messages.push({
          receiver: this.newMessage.receiver,
          message: this.newMessage.message,
          sender: this.newMessage.sender,
        });
        this.refreshForm();
      });
    },

    refreshForm() {
      $("#chat").scrollTop($("#chat")[0].scrollHeight);
      this.newMessage = '';
    },
  },
};
</script>
