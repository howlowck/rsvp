<template>
    <form :action="actionRoute" method="post">
        <input type="hidden" name="_token" :value="token">
        <div class="form-group">
            <label :for="name">File input</label>
            <input :name="name" type="file" class="form-control-file" :id="name" aria-describedby="fileHelp" />
            <small id="fileHelp" class="form-text text-muted">{{helper}}</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            },
            actionRoute: {
                type: String,
                required: true
            },
            helper: {
                type: String,
                required: false
            }
        },
        mounted() {
        },

        data() {
            const token = Laravel.csrfToken
            return {
                token: token
            }
        }
    }
</script>
