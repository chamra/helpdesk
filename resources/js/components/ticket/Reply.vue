<template>
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="alert alert-success" v-if="success">
        Reply has been sent to the customer and ticket has been closed
      </div>
      <div class="alert alert-danger" v-if="invalidStatus">
        {{ invalidStatus }}
      </div>
      <div class="form-group">
        <label>Compose a reply</label>
        <textarea
          :disabled="success"
          class="form-control"
          v-model="formData.content"
          cols="30"
          rows="5"
          @input="clearErrors('content')"
          :class="{ 'is-invalid': hasErrors('content') }"
        ></textarea>
        <small :if="hasErrors('content')" class="form-text text-danger">{{
          hasErrors("content")
        }}</small>
      </div>
      <button
        :disabled="loading || success"
        @click.prevent="reply"
        class="btn btn-primary"
      >
        Submit
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["ticketId"],
  data() {
    return {
      formData: {
        content: "",
      },
      loading: false,
      errors: {},
      success: false,
      invalidStatus : ''
    };
  },
  methods: {
    async reply() {
      this.loading = true;
      this.success = false;

      try {
        this.formData.ticket_id = this.ticketId;

        await axios.post("/reply/create", this.formData);

        this.success = true;
      } catch (error) {
        const { response } = error;
        if (response.status === 422) this.errors = response.data.errors;

        if (response.status === 421) this.invalidStatus = response.data.message;
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