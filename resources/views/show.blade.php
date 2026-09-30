<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Votre conseil - Advisor</title>
    @vite('resources/css/app.css')
</head>
<body class="workshop-page">
    <main class="page-container">
        <h1>Votre conseil personnalisé</h1>
        <p>Vous avez {{ $age }} ans.</p>

        @if ($interet === '')
            <p>Indiquez votre centre d'intérêt avec le paramètre <code>interet</code> pour obtenir un conseil plus précis.</p>
        @elseif (in_array(mb_strtolower($interet), ['developpement', 'développement', 'informatique'], true))
            <p>Votre intérêt pour le développement est une bonne base : créez un petit projet et enrichissez-le progressivement.</p>
        @else
            <p>Pour progresser en {{ $interet }}, choisissez un projet concret et consacrez-y du temps chaque semaine.</p>
        @endif

        @if ($age < 25)
            <p>Profitez de cette période pour explorer plusieurs pistes et développer vos compétences.</p>
        @else
            <p>Appuyez-vous sur votre expérience pour fixer un objectif clair et avancer étape par étape.</p>
        @endif
    </main>
</body>
</html>
