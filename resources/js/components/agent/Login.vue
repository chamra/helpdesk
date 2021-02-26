<template>
  <div>
    <ul class="alert alert-danger" v-if="userNotfound">
      <li>
        {{ userNotfound }}
      </li>
    </ul>

    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          v-model="formData.email"
          type="email"
          class="form-control"
          :class="{ 'is-invalid': hasErrors('email') }"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
          value=""
          @input="clearErrors('email')"
        />
        <small :if="hasErrors('email')" class="form-text text-danger">{{
          hasErrors("email")
        }}</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          v-model="formData.password"
          type="password"
          class="form-control"
          id="exampleInputPassword1"
          placeholder="Password"
          :class="{ 'is-invalid': hasErrors('password') }"
          @input="clearErrors('password')"
        />
        <small :if="hasErrors('password')" class="form-text text-danger">{{
          hasErrors("password")
        }}</small>
      </div>
      <button
        :disabled="loading"
        @click.prevent="login"
        class="btn btn-primary"
      >
        Submit
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        email: "",
        password: "",
      },
      loading: false,
      errors: {},
      userNotfound: "",
    };
  },
  methods: {
    async login(e) {
      this.errors = {};
      this.loading = true;
      try {
        let res = await axios.post("/agent/login", this.formData);

        window.location.href = "/agent/dashboard";
      } catch (error) {
        const { response } = error;

        if (response.status === 422) this.errors = response.data.errors;

        if (response.status === 403) this.userNotfound = response.data.message;
      }

      this.loading = false;
    },
    hasErrors(filed) {
      if (this.errors[filed]) return this.errors[filed].join(",");
    },
    clearErrors(filed) {
      this.errors = _.omit(this.errors, filed);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>