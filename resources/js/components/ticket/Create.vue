<template>
  <div>
    <div class="alert alert-success" v-if="ticketId"> 
        your issue has been successfully sent our support agent and please use this ticket id to follow about your ticket
        {{ ticketId }}
    </div>
    <form>
      <div class="form-group">
        <label>Name</label>
        <input
          v-model="formData.customer_name"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': hasErrors('customer_name') }"
          placeholder="Enter name"
          @input="clearErrors('customer_name')"
        />
        <small :if="hasErrors('customer_name')" class="form-text text-danger">{{
          hasErrors("customer_name")
        }}</small>
      </div>
      <div class="form-group">
        <label>Explain the issue</label>
        <textarea
          class="form-control"
          v-model="formData.description"
          cols="30"
          rows="5"
          :class="{ 'is-invalid': hasErrors('description') }"
        ></textarea>
        <small :if="hasErrors('description')" class="form-text text-danger">{{
          hasErrors("description")
        }}</small>
      </div>
      <div class="form-group">
        <label>Email address</label>
        <input
          v-model="formData.email"
          type="email"
          class="form-control"
          :class="{ 'is-invalid': hasErrors('email') }"
          placeholder="Enter email"
          @input="clearErrors('email')"
        />
        <small :if="hasErrors('email')" class="form-text text-danger">{{
          hasErrors("email")
        }}</small>
      </div>

      <div class="form-group">
        <label
          >Contact number <small class="text-muted">+947XXXXXXXX</small></label
        >
        <input
          v-model="formData.phone"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': hasErrors('phone') }"
          placeholder="Enter contact number (+947XXXXXXXX)"
          @input="clearErrors('phone')"
        />
        <small :if="hasErrors('phone')" class="form-text text-danger">{{
          hasErrors("phone")
        }}</small>
      </div>

      <button
        :disabled="loading"
        @click.prevent="saveTicket"
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
      loading: false,
      formData: {
        customer_name: "",
        phone: "",
        description: "",
        email: "",
      },
      errors: {},
      ticketId : null
    };
  },
  methods: {
    async saveTicket() {

        this.loading = true

        try {
            
            let res = await axios.post('/ticket/create',this.formData)

            this.ticketId = res.data.ticket_id;

        } catch (error) {
            const { response } = error;
            if (response.status === 422) this.errors = response.data.errors;

            this.loading = false
        }

        
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