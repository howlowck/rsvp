<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{test}}!
                {{testa}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            testa: {
                type: String,
                required: true
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                test: 'what up'
            }
        }
    }
</script>
