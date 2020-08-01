<template>
  <div>
    <div class="card-body">
      <ul>
        <li v-for="message in messages">
            {{ message.sender.name }} : {{ message.message }}
        </li>
      </ul>
    </div>
    <div class="card-footer">
      <input type="text" class="form-control" name="message" placeholder="Masukan pesan" />
    </div>
  </div>
</template>

<script>
export default {

props : ['receiver', 'sender'],

  data(){
      return {
          messages: [],
      }
  },

  created(){
    this.fetchMessage();
  },

  methods: {
      fetchMessage(){
        let url = "/chat/"+this.receiver+"/fetch";
        axios.get(url).then(response => {
            this.messages = response.data;   
        });
      }
  }

};
</script>
