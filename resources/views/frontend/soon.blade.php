<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Treza Jewels - Coming Soon</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    height: 100vh;
    background: radial-gradient(circle at top, #1a1a1a, #000);
    font-family: 'Montserrat', sans-serif;
    color: #fff;
    overflow: hidden;
}

/* Animated Gradient Glow */
body::before {
    /*content: '';*/
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(212,175,55,0.4), transparent);
    top: -100px;
    left: -100px;
    animation: moveGlow 10s infinite alternate ease-in-out;
}

@keyframes moveGlow {
    0% { transform: translate(0,0); }
    100% { transform: translate(200px,200px); }
}

/* Glass Card */
.glass-box {
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 0 40px rgba(212,175,55,0.2);
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Logo */
.logo {
    width: 250px;
    animation: float 5s infinite ease-in-out;
}

@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

/* Heading */
h1 {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    letter-spacing: 3px;
}

/* Countdown */
.countdown div {
    display: inline-block;
    margin: 10px;
    padding: 15px 20px;
    border-radius: 15px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(212,175,55,0.4);
    transition: 0.3s;
}

.countdown div:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 15px gold;
}

.countdown span {
    font-size: 30px;
    font-weight: bold;
    color: gold;
}

/* Button */
.btn-gold {
    background: linear-gradient(45deg, #caa74e, #ffd700);
    border: none;
    padding: 12px 30px;
    border-radius: 30px;
    color: #000;
    font-weight: 600;
    transition: 0.4s;
}

.btn-gold:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px gold;
}

/* Input */
input {
    border-radius: 30px;
    padding: 12px 20px;
    border: none;
}

/* Social Icons */
.social i {
    font-size: 20px;
    margin: 10px;
    transition: 0.3s;
}

.social i:hover {
    color: gold;
    transform: scale(1.3);
}

/* Floating particles */
.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: gold;
    border-radius: 50%;
    opacity: 0.6;
    animation: floatUp linear infinite;
}

@keyframes floatUp {
    from { transform: translateY(100vh); }
    to { transform: translateY(-10vh); }
}
</style>
</head>

<body>

<!-- Particles -->
<script>
for(let i=0;i<200;i++){
    let p=document.createElement("div");
    p.className="particle";
    p.style.left=Math.random()*100+"%";
    p.style.animationDuration=(5+Math.random()*10)+"s";
    p.style.opacity=Math.random();
    document.body.appendChild(p);
}
</script>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="glass-box text-center">

        <!-- Logo -->
        <img src="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}" class="logo mb-4" alt="Treza Jewels">

        <h1>Coming Soon</h1>
        <p class="text-light">A new era of luxury is arriving ✨</p>

        <!-- Countdown -->
        <div class="countdown mt-4">
            <div><span id="d">00</span><br>Days</div>
            <div><span id="h">00</span><br>Hours</div>
            <div><span id="m">00</span><br>Minutes</div>
            <div><span id="s">00</span><br>Seconds</div>
        </div>

        <!-- Email -->
        <!--<div class="mt-4 d-flex justify-content-center gap-2">-->
        <!--    <input type="email" placeholder="Enter your email">-->
        <!--    <button class="btn-gold">Notify</button>-->
        <!--</div>-->

        <!-- Social -->
        <!--<div class="social mt-4">-->
        <!--    <i class="bi bi-instagram"></i>-->
        <!--    <i class="bi bi-facebook"></i>-->
        <!--    <i class="bi bi-whatsapp"></i>-->
        <!--</div>-->

    </div>
</div>

<!-- Countdown Script -->
<script>
let date = new Date("May 1, 2026 00:00:00").getTime();

setInterval(()=>{
    let now = new Date().getTime();
    let gap = date - now;

    let d = Math.floor(gap/(1000*60*60*24));
    let h = Math.floor((gap%(1000*60*60*24))/(1000*60*60));
    let m = Math.floor((gap%(1000*60*60))/(1000*60));
    let s = Math.floor((gap%(1000*60))/1000);

    document.getElementById("d").innerHTML=d;
    document.getElementById("h").innerHTML=h;
    document.getElementById("m").innerHTML=m;
    document.getElementById("s").innerHTML=s;
});
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</body>
</html>