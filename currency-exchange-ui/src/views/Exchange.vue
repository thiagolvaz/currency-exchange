<template>
  <Message :msg="msg" v-show="msg" />
  <div>
    <form id="exchange-form" method="GET" @submit="exchange">
      
      <div class="input-container">
        <label for="accessKey">Access Key:</label>
        <input type="text" id="accessKey" name="accessKey" v-model="accessKey" placeholder="Access Key">
      </div>

      <div class="input-container">
        <label for="from">From:</label>
        <select name="from" id="from" v-model="from">
          <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
        </select>
      </div>

      <div class="input-container">
        <label for="fromAmount">Amount:</label>
        <input type="number" id="fromAmount" name="fromAmount" v-model="fromAmount" placeholder="Amount">
      </div>

      <div class="input-container">
        <label for="to">To:</label>
        <select name="to" id="to" v-model="to">
          <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
        </select>
      </div>

      <div class="input-container">
        <label for="toAmount">Amount:</label>
        <input type="number" id="toAmount" name="toAmount" v-model="toAmount" :disabled="true">
      </div>

      <div class="input-container">
        <input class="submit-btn" type="submit" value="Convert">
      </div>
      
    </form>
  </div>
</template>

<script>
import Message from '../components/Message'

export default {
  name: "ExchangeForm",
  data() {
    return {
      currencies: null,

      accessKey: null,
      from: null,
      fromAmount: null,
      to: null,
      toAmount: null,

      msg: null,
    }
  },
  methods: {
    async getCurrencies() {
      const req = await fetch('http://localhost:8000/api/v1/currencies?access_key=0b44d364dcfef4bcd08e502ebfe67e45&base=EUR&symbols=AUD,BRL,CAD,CHF,GBP,JPY,USD')
      const data = await req.json()
      this.currencies = Object.keys(data)
    },
    async exchange(e) {
      e.preventDefault()

      const req = await fetch('http://localhost:8000/api/v1/currencies/exchange?access_key=' + this.accessKey + '&from=' + this.from + '&to=' + this.to + '&amount=' + this.toAmount)
      const data = await req.json()

      if(data.success == true) {
        this.msg = "Successfully converted"
        this.toAmount = data['query'].amount;
      } else {
        this.msg = data['error'].info
      }

      // Clear message
      setTimeout(() => this.msg = "", 4000)

      // Clear fields
      this.accessKey = ""
      this.from = ""
      this.fromAmount = ""
      this.to = ""
      //this.toAmount = ""
    }
  },
  mounted () {
    this.getCurrencies()
  },
  components: {
    Message
  }
}
</script>

<style scoped>
  #exchange-form {
    max-width: 400px;
    margin: 0 auto;
    margin-top: 50px;
  }

  .input-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
  }

  label {
    font-weight: bold;
    margin-bottom: 15px;
    color: #222;;
    padding: 5px 10px;
    border-left: 4px solid #fcba03;
  }

  input, select {
    padding: 5px 10px;
    width: 100%;
  }

  .submit-btn {
    background-color: #222;
    color:#fcba03;
    font-weight: bold;
    border: 2px solid #222;
    padding: 10px;
    font-size: 16px;
    margin: 0 auto;
    cursor: pointer;
    transition: .5s;
    width: 100%;
  }

  .submit-btn:hover {
    background-color: transparent;
    color: #222;
  }
</style>