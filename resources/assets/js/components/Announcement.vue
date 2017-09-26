<template>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Create Announcement</h1>
            <p class="text-muted">Announcements you create here will be sent to the "Announcements" section of the notifications window.</p>

                <div class="form-group">
                    <label class="form-control-label">Message</label>
                    <textarea v-model="message" class="form-control" name="message" rows="5" placeholder="Enter your announcement message here"></textarea>
                </div>
                <div class="form-group text-right">
                    <a class="btn btn-link btn-secondary" href="#">Cancel</a>
                    <button @click.prevent="submit" class="btn btn-primary">Send</button>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            }
        },
        mounted() {

        },
        methods: {
            submit() {
                axios.post('/admin/announcements', {message: this.message})
                    .then(response => {
                        this.message = '';
                    })
                    .catch(error => {

                    })
            }
        }
    }
</script>
