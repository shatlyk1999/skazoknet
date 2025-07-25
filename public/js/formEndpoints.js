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
    recoveryPasswordForm: {
        endpoint: "/password/reset",
        method: "POST",
        redirectPath: "/recovery-confirmed",
    },
    // editUserForm: {
    //     endpoint: "/user-update/" + user_id,
    //     method: "POST",
    //     redirectPath: "/user-profile/" + user_id,
    // },
};

export default formEndpoints;
