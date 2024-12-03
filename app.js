// Firebase configuration
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    appId: "YOUR_APP_ID"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Get elements
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const resetPasswordForm = document.getElementById('reset-password-form');
const profileForm = document.getElementById('profile-form');
const userEmail = document.getElementById('user-email');

// Login
if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        firebase.auth().signInWithEmailAndPassword(email, password)
            .then((userCredential) => {
                const user = userCredential.user;
                fetch('config.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ action: 'login', user: { email: user.email, uid: user.uid } }),
                })
                .then(() => {
                    window.location.href = 'welcome.php';
                });
            })
            .catch((error) => {
                alert(error.message);
            });
    });
}

// Register
if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        firebase.auth().createUserWithEmailAndPassword(email, password)
            .then((userCredential) => {
                const user = userCredential.user;
                fetch('config.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ action: 'register', user: { email: user.email, uid: user.uid } }),
                })
                .then(() => {
                    window.location.href = 'welcome.php';
                });
            })
            .catch((error) => {
                alert(error.message);
            });
    });
}

// Reset Password
if (resetPasswordForm) {
    resetPasswordForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        firebase.auth().sendPasswordResetEmail(email)
            .then(() => {
                alert('Password reset email sent. Check your inbox.');
                window.location.href = 'login.php';
            })
            .catch((error) => {
                alert(error.message);
            });
    });
}

// Update Profile
if (profileForm) {
    profileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const displayName = document.getElementById('displayName').value;
        const user = firebase.auth().currentUser;
        
        user.updateProfile({
            displayName: displayName
        }).then(() => {
            fetch('config.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'updateProfile', user: { displayName: displayName, uid: user.uid } }),
            })
            .then(() => {
                alert('Profile updated successfully');
                window.location.href = 'welcome.php';
            });
        }).catch((error) => {
            alert(error.message);
        });
    });
}

// Check auth state
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        if (userEmail) {
            userEmail.textContent = user.email;
        }
    } else {
        if (window.location.pathname.includes('welcome.php') || 
            window.location.pathname.includes('profile.php')) {
            window.location.href = 'login.php';
        }
    }
});
