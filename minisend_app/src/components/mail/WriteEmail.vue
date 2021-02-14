<template>
  <div class="card write-email">
    <div class="card-content">
      <h1 class="is-size-3 mb-4">New Email</h1>
      <form action="">
        <b-field label="To">
          <b-input v-model="to"></b-input>
        </b-field>
        <b-field label="Subject">
          <b-input v-model="subject"></b-input>
        </b-field>
        <b-field label="Message">
          <b-input v-model="body" type="textarea"></b-input>
        </b-field>

        <b-field class="file">
          <b-upload v-model="attachments" expanded multiple>
            <a class="button is-info is-fullwidth">
              <b-icon icon="attachment"></b-icon>
              <span>Select attachments</span>
            </a>
          </b-upload>
        </b-field>
        <div class="tags">
            <span v-for="(file, index) in attachments"
                  :key="index"
                  class="tag is-info is-light">
                {{ file.name }}
                <button class="delete is-small"
                        type="button"
                        @click="removeAttachment(index)">
                </button>
            </span>
        </div>

        <div class="actions mt-4">
          <b-button :loading="loading" icon-left="send" type="is-primary" @click="sendMail()">Send</b-button>
          <b-button :disabled="loading" icon-left="close" class="ml-2" type="is-danger" @click="$emit('cancel')">Cancel</b-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "WriteEmail",
  data: () => {
    return {
      to: '',
      subject: '',
      body: '',
      attachments: [],
      loading: false
    }
  },
  methods: {
    sendMail() {
      this.loading = true;
      const formData = new FormData();

      this.attachments.forEach((file, index) => {
        formData.append('image' + index, file);
      });

      formData.append('to', this.to);
      formData.append('subject', this.subject);
      formData.append('body', this.body);

      this.$store.dispatch('email/sendMail', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(() => {
        this.$emit('emailSent');
      }).finally(() => this.loading = false);
    },
    removeAttachment(index) {
      this.attachments.splice(index, 1)
    }
  }
}
</script>

<style lang="scss">
.write-email {
  width: 900px;

  .upload {
    width: 100%;

    .upload-draggable {
      width: 100%;

      .dropzone {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    }
  }
}
</style>
