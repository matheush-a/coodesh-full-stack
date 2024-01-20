<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-toolbar-title>
          Coodesh
        </q-toolbar-title>
      </q-toolbar>
    </q-header>
    
    <usuario-list/>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import UsuarioList from 'components/UsuarioList.vue'

export default defineComponent({
  name: 'MainLayout',

  components: {
    UsuarioList,
  },
})
</script>

<style scoped lang="scss">
q-layout {
  padding: 1rem;
}
</style>
