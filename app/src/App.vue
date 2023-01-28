<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <ConsumptionForm />
  </div>
</template>

<script>
import ConsumptionForm from './components/ConsumptionForm'

export default {
  name: 'App',
  components: {
    ConsumptionForm
  }
}
</script>

<style>
@import '~normalize.css';
@import "~vue-select/dist/vue-select.css";
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background: #020202;
  padding: 0;
}

body {
  padding: 0;
  background: #020202;
}

* {
  box-sizing: border-box;
}
</style>
