<template>
  <q-layout view="lHh Lpr lFf">
    <snackbar-element ref="snackbar"/>
    <q-header elevated>
      <q-toolbar>
        <span @click="goBack">
          Coodesh
        </span>
        <q-space />
      </q-toolbar>
    </q-header>
  
    <q-page-container class="user-form-container">
      <q-page class="user-form-page">
        <h4>Usuário</h4>
        <q-form class="user-form" @submit="saveUser">
          <q-input
            v-model="user.nome"
            label="Nome"
            outlined
            dense
          />
          <q-input
            v-model="user.email"
            label="Email"
            outlined
            dense
          />
          <q-input
            v-model="user.senha"
            label="Senha"
            type="password"
            outlined
            dense
          />
        </q-form>
        <q-btn class="save-user" @click="saveUser">
          Salvar
        </q-btn>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import UsuarioService from 'src/services/usuario.service';
import SnackbarElement from 'src/components/SnackbarElement.vue';

export default {
  data() {
    return {
      user: {
        id: null,
        nome: '',
        email: '',
      },
    };
  },
  components: {
    SnackbarElement,
  },
  mounted() {
    if (this.$route.params.id) {
      this.fetchUser(this.$route.params.id);
    }
  },
  methods: {
    async fetchUser(userId) {
      await UsuarioService.getById(userId)
        .then(response => {
          this.user = response.data;
        })
        .catch((data) => {
          this.$refs.snackbar.showSnackbar(data.response.data, "error");
          this.$refs.snackbar.showSnackbar(error, "error");
        });
    },
    async saveUser() {
      if (this.user.id) {
        await UsuarioService.update(this.user)
          .then(() => {
            this.$refs.snackbar.showSnackbar("Usuário atualizado com sucesso!", "success");

            setTimeout(() => {
              this.$router.push('/');
            }, 1500);
          })
          .catch((data) => {
            this.$refs.snackbar.showSnackbar(data.response.data, "error");
          });
      } else {
        await UsuarioService.store(this.user)
          .then(() => {
            this.$refs.snackbar.showSnackbar("Usuário criado com sucesso!", "success");

            setTimeout(() => {
              this.$router.push('/');
            }, 1500);
          })
          .catch((error) => {
            this.$refs.snackbar.showSnackbar(error, "error");
          });
      }

    },
    goBack() {
      this.$router.push('/');
    },
  },
};
</script>

<style scoped lang="scss">
span {
  cursor: pointer;
}

.user-form-container {
  display: flex;
  justify-content: center;
  width: 100%;
  margin: 1rem;
}

.user-form-page {
  width: 40%;

  >.user-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
}

.save-user {
  margin-top: 1.5rem;
  background-color: green;
  color: white;
}
</style>
