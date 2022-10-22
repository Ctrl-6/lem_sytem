<template>
  <v-container>
    <v-row>
      <v-col class="about">
        <h1>Soporte</h1>
      </v-col>
    </v-row>
    <v-row>
      <instalations/>
    </v-row>
    
    

  </v-container>
</template>

<script>
import Instalations from '../components/Support.vue'


export default {
  name: 'App',
  components: {
    Instalations
  },
  methods:{

  }
}
</script>

