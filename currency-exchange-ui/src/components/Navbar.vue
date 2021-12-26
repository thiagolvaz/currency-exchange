<template>
  <div>
    <div id="nav">
      <router-link to="/currencies">Currencies</router-link> |
      <router-link to="/exchange">Exchange</router-link>
    </div>
  </div>
</template>

<script>
export default {
    name: "Navbar"
}
</script>

<style scoped>
  #nav {
    background-color: #222;
    border-bottom: 4px solid #111;
    padding: 15px 50px;
    text-align: center;
  }

  #nav a {
    color: #fcba03;
    text-decoration: none;
    margin: 12px;
    transition: .5s;
  }

  #nav a:hover {
    color: #FFF;
  }
</style>