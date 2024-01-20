<template>
  <q-page-container>
    <snackbar ref="snackbar" />
    <q-page class="user-list">
      <q-header elevated>
        <q-toolbar>
          <span>
            Coodesh
          </span>
          <div class="wrapper">
            <q-btn class="add-user-btn" @click="goToAddUserPage" label="Criar usuário" />
          </div>
        </q-toolbar>
      </q-header>

      <q-page-container>
        <q-table
          :rows="users"
          :columns="columns"
          row-key="id"
          :rows-per-page-options="[10, 20]"
        >
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td auto-width>
                {{ props.row.nome }}
              </q-td>
              <q-td auto-width>
                {{ props.row.email }}
              </q-td>
              <q-td class="actions-td" auto-width>
                <q-btn class="action-btn edit" @click="goToEditUserPage(props.row.id)" icon="edit" />
                <q-btn class="action-btn delete" @click="deleteUser(props.row.id, props.row.email)" icon="delete" />
              </q-td>
            </q-tr>
          </template>
        </q-table>
      </q-page-container>
    </q-page>
  </q-page-container>
</template>

<script>
import UsuarioService from 'src/services/usuario.service';

export default {
  data() {
    return {
      users: [],
      columns: [
        { name: 'name', label: 'Nome', align: 'left', field: 'nome', sortable: true },
        { name: 'email', label: 'Email', align: 'left', field: 'email', sortable: true },
        { name: 'actions', label: 'Opções', align: 'left' },
      ],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      UsuarioService.get()
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error('Error fetching users:', error);
        });
    },
    goToEditUserPage(userId) {
      this.$router.push(`/add-user/${userId}`);
    },
    goToAddUserPage() {
      this.$router.push('/add-user');
    },
    deleteUser(userId, email) {
      if (window.confirm(`Você tem certeza que deseja deletar o usuário ${email}?`)) {
        UsuarioService.delete(userId)
          .then(() => {
            this.fetchUsers();
          })
          .catch(error => {
            console.error('Error deleting user:', error);
          });
      }
    },
  },
};
</script>

<style scoped lang="scss">
.user-list {
  margin: 1rem;
}

.wrapper {
  display: flex;
  justify-content: end;
  align-items: end;
  width: 100%;
}

.add-user-btn {
  background-color: white;
  color: black;
}

.action-btn {
  margin: .5rem;
  color: white;

  &.edit {
    background-color: green;
  }

  &.delete {
    background-color: brown;
  }
}
</style>
