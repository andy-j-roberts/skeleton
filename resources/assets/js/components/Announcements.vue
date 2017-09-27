<template>
    <div class="container mb-5">
        <h2>Announcements <span class="badge badge-success" v-show="announcements.length > 0">{{ announcements.length
            }}</span></h2>
        <div class="alert alert-warning" v-if="announcements.length == 0">No announcements have been made.</div>
        <ul class="list-group">
            <li class="list-group-item announcement" v-for="announcement in announcements">
                <div class="row align-items-center">
                    <div class="col-auto mr-auto">
                        <img :src="announcement.avatar" alt="avatar" class="rounded-circle mr-2" width="32px">
                        <h5 class="d-inline-block">{{ announcement.username }}</h5>
                    </div>
                </div>
                <hr/>
                <p class="lead">{{ announcement.message }}</p>

            </li>
        </ul>
    </div>
</template>
<style>
    .announcement:hover {
        background: RGBA(46, 204, 113, 0.05);
        cursor: pointer;
    }
</style>
<script>
    export default {
        data() {
            return {
                announcements: []
            }
        },
        mounted() {
            Echo.channel('announcements')
                .listen('.app.announcement', (e) => {
                    this.announcements.unshift(e);
                });
        }
    }
</script>
