// const BASE_URL = "https://skazoknet.com";

const formEndpoints = {
    registerForm: {
        endpoint: "/register",
        method: "POST",
        redirectPath: "/send-email-register-verify",
    },
    loginForm: {
        endpoint: "login",
        method: "POST",
        redirectPath: "/",
    },
    // recoveryPasswordForm: {
    //     endpoint: "https://api.example.com/recover-password",
    //     method: "POST",
    //     redirectPath: "/login",
    // },
    // editUserForm: {
    //     endpoint: "https://api.example.com/edit-user",
    //     method: "PUT",
    //     redirectPath: "/profile",
    // },
};

export default formEndpoints;
