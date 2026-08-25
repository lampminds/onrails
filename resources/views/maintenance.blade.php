<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Sitio en mantenimiento — OnRails</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <style>
        :root {
            --brand-red: #D10024;
            --brand-slate: #4A5C78;
            --brand-ink: #2B2D42;
            --brand-muted: #8D99AE;
            --brand-paper: #F7F8FA;
            --brand-gold: #F0C43A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Montserrat, sans-serif;
            color: var(--brand-ink);
            background:
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(209, 0, 36, 0.12), transparent 55%),
                linear-gradient(165deg, #ffffff 0%, var(--brand-paper) 45%, #e8ecf2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.25rem;
        }

        .maintenance {
            width: min(640px, 100%);
            text-align: center;
        }

        .maintenance__logo {
            display: inline-block;
            margin-bottom: 1.75rem;
            animation: maintenance-fade-up 0.7s ease-out both;
        }

        .maintenance__logo img {
            display: block;
            width: min(280px, 72vw);
            height: auto;
        }

        .maintenance__visual {
            margin: 0 auto 1.75rem;
            max-width: 50%;
            animation: maintenance-fade-up 0.85s ease-out 0.12s both;
        }

        .maintenance__visual img {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 18px 40px rgba(42, 53, 69, 0.18);
        }

        .maintenance__title {
            font-size: clamp(1.35rem, 3.5vw, 1.85rem);
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--brand-slate);
            margin-bottom: 0.75rem;
            animation: maintenance-fade-up 0.85s ease-out 0.22s both;
        }

        .maintenance__text {
            font-size: 1rem;
            line-height: 1.65;
            color: var(--brand-muted);
            max-width: 34rem;
            margin: 0 auto;
            animation: maintenance-fade-up 0.85s ease-out 0.32s both;
        }

        .maintenance__accent {
            display: block;
            width: 64px;
            height: 3px;
            margin: 1.5rem auto 0;
            background: linear-gradient(90deg, var(--brand-red), var(--brand-gold));
            border-radius: 2px;
            animation: maintenance-fade-up 0.85s ease-out 0.4s both;
        }

        @keyframes maintenance-fade-up {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .maintenance__logo,
            .maintenance__visual,
            .maintenance__title,
            .maintenance__text,
            .maintenance__accent {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <main class="maintenance">
        <a class="maintenance__logo" href="{{ url('/') }}" aria-label="OnRails">
            <img src="{{ asset('img/logo-onrails.svg') }}" alt="OnRails">
        </a>

        <figure class="maintenance__visual">
            <img
                src="{{ asset('img/under-maintenance.png') }}"
                alt="Trabajos de mejora en el sitio"
                width="960"
                height="640"
            >
        </figure>

        <h1 class="maintenance__title">Estamos mejorando el sitio</h1>
        <p class="maintenance__text">
            En este momento realizamos trabajos de mejora para ofrecerte una mejor experiencia.
            Volvé a visitarnos en breve; gracias por tu paciencia.
        </p>
        <span class="maintenance__accent" aria-hidden="true"></span>
    </main>
</body>
</html>
