<template>
  <div>
    <div id="currency-table" v-if="currencies">
        <div>
          <div id="currency-table-heading">
            <div>Symbol:</div>
            <div>Rate:</div>
          </div>
        </div>
        <div id="currency-table-rows">
          <div class="currency-table-row" v-for="currency in currencies" :key="currency">
            <div class="order-number">{{ currency.id }}</div>
            <div>{{ currency.symbol }}</div>
            <div>{{ currency.rate }}</div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    name: "Currencies",
    data() {
      return {
        currencies: [],
      }
    },
    methods: {
      async getCurrencies() {
        const req = await fetch('http://localhost:8000/api/v1/currencies?access_key=0b44d364dcfef4bcd08e502ebfe67e45&base=EUR&symbols=AUD,BRL,CAD,CHF,GBP,JPY,USD')

        const data = await req.json()

        for(var key in data) {
          var value = data[key]

          var currency = {
            symbol: key,
            rate: value
          }
  
          this.currencies.push(currency)
        }
      }
    },
    mounted() {
      this.getCurrencies()
    }
  }
</script>

<style scoped>
  #currency-table {
    max-width: 400px;
    margin: 0 auto;
    margin-top: 50px;
    text-align: center;
  }

  #currency-table-heading,
  #currency-table-rows,
  .currency-table-row {
    display: flex;
    flex-wrap: wrap;
  }

  #currency-table-heading {
    font-weight: bold;
    padding: 12px;
    border-bottom: 3px solid #333;
  }

  .currency-table-row {
    width: 100%;
    padding: 12px;
    border-bottom: 1px solid #CCC;
  }

  #currency-table-heading div,
  .currency-table-row div {
    width: 47%;
  }

  #currency-table-heading .order-id,
  .currency-table-row .order-number {
    width: 5%;
  }
  
</style>


















































<!--
<template>
  <div class="main-container">
    <h1>This is an Currencies page</h1>
    <pre>
      {{ currencies }}
    </pre>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        currencies: []
      }
    },

    created() {
      fetch('http://localhost:8000/api/v1/currencies?access_key=0b44d364dcfef4bcd08e502ebfe67e45&base=EUR&symbols=BRL,USD,GBP,JPY')
      .then(response => response.json())
      .then(r => {
        this.currencies = r;
      })
    },
  }
</script>
-->