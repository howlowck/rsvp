<template>
    <form :action="actionRoute" method="post">
        <input type="hidden" name="_token" :value="token">
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Enter Email" />
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input name="password" type="password" class="form-control" id="pass" placeholder="Password" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
    export default {
        props: {
            actionRoute: {
                type: String,
                required: true
            },
            token: {
                type: String,
                required: true
            }
        },
        mounted() {
        },

        data() {
            return {
            }
        }
    }
</script>
