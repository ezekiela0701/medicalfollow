<script setup>
  import { RouterLink, RouterView } from 'vue-router'
  // import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <header>

    <div class="wrapper">
      <HelloWorld msg="You did it!" />

      <nav>
        <RouterLink to="/">List des médicaments</RouterLink>
        <RouterLink to="/medocAdd">Ajouter médicament</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>