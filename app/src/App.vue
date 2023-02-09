<template>
  <div id="app">
    <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" 
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" 
        crossorigin="anonymous">
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
@import '/fonts/index.css';

@import '~normalize.css';
@import "~vue-select/dist/vue-select.css";
#app {
  font-family: 'Gotham Pro', Helvetica, Arial, sans-serif;
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

body, button, input, optgroup, select, textarea {
  font-family: 'Gotham Pro', Helvetica, Arial, sans-serif!important;
}

* {
  box-sizing: border-box;
}
</style>
