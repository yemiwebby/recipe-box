<template>
    <form class="form" @submit.prevent="login">
        <h1 class="form__title">Welcome back!</h1>
        <div class="form__group">
            <label>Email</label>
            <input type="email" class="form__control" v-model="form.email">
            <small class="error__control" v-if="error.email">{{ error.email[0]}}</small>
        </div>

        <div class="form__group">
            <label>Password</label>
            <input type="password" class="form__control" v-model="form.password">
            <small class="error__control" v-if="error.password">{{ error.password[0]}}</small>
        </div>
        <div class="form__group">
            <button :disabled="isProcessing" class="btn btn__primary">
                Login
            </button>
        </div>
    </form>
</template>

<script type="text/babel">
    import Flash from '../../helpers/flash'
    import { post } from '../../helpers/api'
    import Auth from '../../store/auth'
    export default {
        data(){
            return{
                form: {
                    email: '',
                    password: ''
                },
                error: {},
                isProcessing: false
            }
        },
        methods: {
            login(){
                this.isProcessing = true;
                this.error = {}
                post('/api/login', this.form)
                        .then((res) => {
                    if(res.data.authenticated){
                        Auth.set(res.data.api_token, res.data.user_id)
                        Flash.setSuccess('You have successfully Logged Im!!');
                        this.$router.push('/')
                    }

                    this.isProcessing = false;
                })
            .catch((err) => {
                    if(err.response.status === 422){
                        this.error = err.response.data
                    }
                    this.isProcessing = false;
                })
            }
        }
    }
</script>