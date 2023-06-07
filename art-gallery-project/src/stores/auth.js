import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authErrors: [],
        authStatus: null,
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors,
        status: (state) => state.authStatus,
    },
    actions: {
        async getToken() {
            const data = await axios.get("/sanctum/csrf-cookie");
            console.log(data);
        },
        async getUser() {
            await this.getToken();
            try {
                const data = await axios.get("/api/user");
                this.authUser = data.data;
            } catch (error) {
                console.log(error);
            }
        },
        async handleLogin(data) {
            this.authErrors = [];
            await this.getToken();

            try {
                await axios.post("/login", {
                    email: data.email,
                    password: data.password,
                });
                this.router.push("/home");
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },
        async handleRegister(data) {
            this.authErrors = [];
            await this.getToken();
            try {
                await axios.post("/register", {
                    name: data.name,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation,
                    user_role: data.user_role,
                });
                this.router.push("/");
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },
        async handleLogout() {
            await axios.post("/logout");
            this.authUser = null;
        },
        async handleForgotPassword(email) {
            this.authErrors = [];
            this.getToken();
            try {
                const response = await axios.post("/forgot-password", {
                    email: email,
                });
                this.authStatus = response.data.status;
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },
        async handleResetPassword(resetData) {
            this.authErrors = [];
            try {
                const response = await axios.post("/reset-password", resetData);
                this.authStatus = response.data.status;
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },
    },
});
