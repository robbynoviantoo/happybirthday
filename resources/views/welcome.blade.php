<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Happy Birthday!</title>
    <link rel="icon" href="public/hwi.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap');

        body{}
        .small-img {
            width: 100px;
            /* Atur lebar sesuai kebutuhan */
            height: 100px;
            /* Atur tinggi sesuai kebutuhan */
            object-fit: cover;
            /* Memastikan gambar terpotong dengan baik */
            border-radius: 50%;
            /* Jika ingin gambar berbentuk lingkaran */
            transition: transform 0.3s ease;
            /* Transisi untuk efek hover */
        }

        .small-img:hover {
            transform: scale(1.5) rotate(360deg);
            /* Membesarkan dan memutar gambar saat hover */
        }

        .container-custom {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
        }

        .card {
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            /* Tambahkan transisi */
            background-color: rgba(255, 255, 255, 0.2);
            /* Warna latar belakang lebih transparan */
            /* Warna latar belakang dengan transparansi */
            border: 1px solid rgba(255, 255, 255, 0.5);
            /* Border putih dengan transparansi */
            /* Border dengan transparansi */
            border-radius: 50px;
            backdrop-filter: blur(10px);
            /* Efek blur untuk tampilan kaca */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Bayangan lembut */
            color: white;
        }

        .card:hover {
            transform: translateY(-10px) rotateY(5deg);
            /* Efek 3D saat hover */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            /* Bayangan saat hover */
        }

        .card-header {
            background-color: #f8f9fa;
        }

        h2 {
            font-size: 50px;
            color: white;
            padding-bottom: 20px;
            font-family: "DM Serif Display", serif;
            font-weight: 400;
            font-style: normal;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .salju {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            pointer-events: none;
            z-index: 20
        }

        .cont-salju {
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1
        }

        .meja {
            width: 100%;
            /* Mengatur lebar tabel */
            border-collapse: collapse;
            /* Menghilangkan jarak antara border sel */
        }

        .meja th,
        .meja td {
            padding: 12px;
            /* Mengatur padding sel */
            text-align: left;
            /* Mengatur perataan teks */
        }

        .header-card {
            padding-top: 1rem;
            /* Padding untuk header */
            text-align: center;
            /* Perataan teks di tengah */
            font-weight: bold;
            /* Menebalkan teks */
            color: white;
            /* Warna teks */
            font-size: 24px;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        .row{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
    <canvas class='salju' id='salju'></canvas>
</head>

<body>
    <div class="container-custom d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-12">
                <h2 id="birthday-title" class="text-center mb-4 fade-in">{{ __('ORANG YANG ULANG TAHUN HARI INI') }}
                </h2>
                <div class="row">
                    @if (count($birthdays) > 0)
                        @foreach ($birthdays as $birthday)
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm" style="min-height: 300px; ">
                                    <div class="header-card text-center">
                                        <strong>{{ $birthday->name }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="meja">
                                            <tbody>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>: {{ date('d F', strtotime($birthday->tanggal_lahir)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NIK</th>
                                                    <td>: {{ $birthday->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <td>:
                                                        <span id="position-{{ $birthday->nik }}"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-center">
                                                        <!-- Menggunakan colspan untuk menempatkan gambar di tengah -->
                                                        <img id="image-{{ $birthday->nik }}" alt="{{ $birthday->name }}"
                                                            class="img-fluid small-img" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    axios.get(`http://10.20.10.44/employee-management/api/employees/{{ $birthday->nik }}`, {
                                            headers: {
                                                'Authorization': 'Bearer 2|fNvm7iJfonvNxyfYYKEc5qXKhlQlO4Ff99AMgZId118b07bd',
                                                'Accept': 'application/json'
                                            }
                                        })
                                        .then(response => {
                                            const {
                                                photo,
                                                position
                                            } = response.data;
                                            const imageElement = document.getElementById('image-{{ $birthday->nik }}');
                                            const positionElement = document.getElementById('position-{{ $birthday->nik }}');
                                            const basePath = 'http://10.20.10.44/employee-management/storage/app/public/';

                                            if (photo) {
                                                imageElement.src = basePath + photo;
                                            } else {
                                                console.error('Photo URL not found in response');
                                            }

                                            if (position) {
                                                positionElement.textContent = position;
                                            } else {
                                                console.error('Position not found in response');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                });
                            </script>
                        @endforeach
                    @else
                        <p class="text-center">Tidak ada orang yang ulang tahun hari ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Canvas untuk latar belakang -->
    <canvas id="fireworkCanvas"></canvas>


    <script type='text/javascript'>
        //<![CDATA[
        ! function() {
            function t(t) {
                var n = t.getContext("2d"),
                    e = 0,
                    i = 0,
                    o = [],
                    d = function() {
                        this.x = this.y = this.dx = this.dy = 0, this.reset()
                    };

                function a() {
                    e = window.innerWidth, i = window.innerHeight, t.width = e, t.height = i,
                        function(t) {
                            if (t != o.length) {
                                o = [];
                                for (var n = 0; n < t; n++) o.push(new d)
                            }
                        }(e * i / 1e4)
                }
                d.prototype.reset = function() {
                        this.y = Math.random() * i, this.x = Math.random() * e, this.dx = 1 * Math.random() - .5, this.dy =
                            .5 * Math.random() + .5
                    }, a(),
                    function t() {
                        n.clearRect(0, 0, e, i), n.fillStyle = "rgba(255,255,255,.3)", o.forEach(function(t) {
                            t.y += t.dy, t.x += t.dx, t.y > i && (t.y = 0), t.x > e && (t.reset(), t.y = 0), n
                                .beginPath(), n.arc(t.x, t.y, 5, 0, 2 * Math.PI, !1), n.fill()
                        }), window.requestAnimationFrame(t)
                    }(), window.addEventListener("resize", a)
            }
            var n;
            n = function() {
                t(document.getElementById("salju"))
            }, "loading" != document.readyState ? n() : document.addEventListener("DOMContentLoaded", n)
        }();
        //]]>
    </script>

    <script>
        var rnd = Math.random,
            flr = Math.floor;
        let canvas = document.getElementById('fireworkCanvas');

        // Atur ukuran kanvas
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.zIndex = '-1'; // Pastikan kanvas berada di belakang konten
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let ctx = canvas.getContext('2d');

        function rndNum(num) {
            return rnd() * num + 1;
        }

        function vector(x, y) {
            this.x = x;
            this.y = y;

            this.add = function(vec2) {
                this.x = this.x + vec2.x;
                this.y = this.y + vec2.y;
            }
        }

        function particle(pos, vel) {
            this.pos = new vector(pos.x, pos.y);
            this.vel = vel;
            this.finish = false;
            this.start = 0;

            this.update = function(time) {
                let timeSpan = time - this.start;

                if (timeSpan > 500) {
                    this.finish = true;
                }

                if (!this.finish) {
                    this.pos.add(this.vel);
                    this.vel.y = this.vel.y + gravity;
                }
            };

            this.draw = function() {
                if (!this.finish) {
                    drawDot(this.pos.x, this.pos.y, 1);
                }
            }

        }

        function firework(x, y) {
            this.pos = new vector(x, y);
            this.vel = new vector(0, -rndNum(10) - 3);
            this.color = 'hsl(' + rndNum(360) + ', 100%, 50%)'
            this.size = 4;
            this.finish = false;
            this.start = 0;
            let exParticles = [],
                exPLen = 100;

            let rootShow = true;

            this.update = function(time) {
                if (this.finish) {
                    return;
                }

                rootShow = this.vel.y < 0;

                if (rootShow) {
                    this.pos.add(this.vel);
                    this.vel.y = this.vel.y + gravity;
                } else {
                    if (exParticles.length === 0) {
                        flash = true;
                        for (let i = 0; i < exPLen; i++) {
                            exParticles.push(new particle(this.pos, new vector(-rndNum(10) + 5, -rndNum(10) + 5)));
                            exParticles[exParticles.length - 1].start = time;
                        }
                    }
                    let countFinish = 0;
                    for (let i = 0; i < exPLen; i++) {
                        let p = exParticles[i];
                        p.update(time);
                        if (p.finish) {
                            countFinish++;
                        }
                    }

                    if (countFinish === exPLen) {
                        this.finish = true;
                    }

                }
            }

            this.draw = function() {
                if (this.finish) {
                    return;
                }

                ctx.fillStyle = this.color;
                if (rootShow) {
                    drawDot(this.pos.x, this.pos.y, this.size);
                } else {
                    for (let i = 0; i < exPLen; i++) {
                        let p = exParticles[i];
                        p.draw();
                    }
                }
            }

        }

        function drawDot(x, y, size) {
            ctx.beginPath();

            ctx.arc(x, y, size, 0, Math.PI * 2);
            ctx.fill();

            ctx.closePath();
        }

        var fireworks = [],
            gravity = 0.2,
            snapTime = 0,
            flash = false;

        function init() {
            let numOfFireworks = 20;
            for (let i = 0; i < numOfFireworks; i++) {
                fireworks.push(new firework(rndNum(canvas.width), canvas.height));
            }
        }

        function update(time) {
            for (let i = 0, len = fireworks.length; i < len; i++) {
                let p = fireworks[i];
                p.update(time);
            }
        }

        function draw(time) {
            update(time);

            ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
            if (flash) {
                flash = false;
            }
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = 'white';
            ctx.font = "30px Segoe UI";
            let newTime = time - snapTime;
            snapTime = time;

            ctx.fillStyle = 'blue';
            for (let i = 0, len = fireworks.length; i < len; i++) {
                let p = fireworks[i];
                if (p.finish) {
                    fireworks[i] = new firework(rndNum(canvas.width), canvas.height);
                    p = fireworks[i];
                    p.start = time;
                }
                p.draw();
            }

            window.requestAnimationFrame(draw);
        }

        window.addEventListener('resize', function() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        init();
        draw();
    </script>

    <script>
        // Menambahkan animasi gerakan untuk judul
        let title = document.getElementById('birthday-title');
        let position = 0;
        let direction = 1; // 1 untuk bergerak ke kanan, -1 untuk kiri

        function animateTitle() {
            position += direction; // Update posisi
            if (position > 20 || position < -20) { // Ubah arah jika mencapai batas
                direction *= -1;
            }
            title.style.transform = `translateX(${position}px)`; // Terapkan transformasi
            requestAnimationFrame(animateTitle); // Panggil fungsi lagi untuk animasi
        }

        window.addEventListener('load', function() {
            title.classList.add('visible');
            animateTitle(); // Mulai animasi saat halaman dimuat
        });
    </script>

    <script>
        // Fungsi untuk animasi kartu dengan gerakan lebih terlihat
        function animateCards() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                const rect = card.getBoundingClientRect();
                const cardX = rect.left + rect.width / 2;
                const cardY = rect.top + rect.height / 2;

                const deltaX = Math.sin(Date.now() / 500 + index) *
                    15; // Gerakan acak berdasarkan waktu, lebih besar
                const deltaY = Math.cos(Date.now() / 500 + index) *
                    15; // Gerakan acak berdasarkan waktu, lebih besar

                card.style.transform =
                    `translateY(-10px) rotateX(${deltaY}deg) rotateY(${deltaX}deg)`; // Besarkan efek
            });
            requestAnimationFrame(animateCards); // Panggil fungsi lagi untuk animasi
        }

        window.addEventListener('load', function() {
            animateCards(); // Mulai animasi saat halaman dimuat
        });

        document.addEventListener('mousemove', function(event) {
            const cards = document.querySelectorAll('.card');
            const {
                clientX,
                clientY
            } = event;

            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardX = rect.left + rect.width / 2;
                const cardY = rect.top + rect.height / 2;

                const deltaX = clientX - cardX;
                const deltaY = clientY - cardY;

                const tiltX = (deltaY / 3); // Atur sensitivitas untuk efek lebih besar
                const tiltY = (deltaX / 3); // Atur sensitivitas untuk efek lebih besar

                // Hanya terapkan efek pada kartu yang terkena mouse
                if (rect.left <= clientX && clientX <= rect.right && rect.top <= clientY && clientY <= rect
                    .bottom) {
                    card.style.transform =
                        `translateY(-20px) rotateX(${-tiltX}deg) rotateY(${tiltY}deg)`; // Besarkan efek
                } else {
                    card.style.transform =
                        'translateY(0) rotateX(0deg) rotateY(0deg)'; // Reset transformasi
                }
            });
        });

        document.addEventListener('mouseleave', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.transform = 'translateY(0) rotateX(0deg) rotateY(0deg)'; // Reset transformasi
            });
        });
    </script>
</body>

</html>
