<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../style/inscription.css">
    <link rel="stylesheet" href="../style/header_general.css">
    <link rel="stylesheet" href="../style/footer_general.css">
</head>

<body>
    <?php include("header_general.php"); ?>

    <main>
    <div id="loading-message" style="display:none;">
            <p>Email en cours d'envoi...</p>
            <div class="loader"></div>
        </div>
        <style>
            #loading-message {
                text-align: center;
                margin-top: 20px;
            }

            .loader {
                border: 4px solid rgba(0, 0, 0, 0.1);
                border-radius: 50%;
                border-top: 4px solid #3498db;
                width: 30px;
                height: 30px;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <div class="container">
            <h2>Formulaire d'inscription</h2>
            <form id="registrationForm">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select id="sexe" name="sexe" required>
                        <option value="">Sélectionner...</option>
                        <option value="masculin">Masculin</option>
                        <option value="feminin">Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse" required>
                    <div class="error" id="password-error" style="display:none;">Le mot de passe doit contenir au moins 6 caractères, une lettre majuscule et un chiffre.</div>
                </div>
                <div class="form-group">
                    <label for="confirmation">Confirmation du mot de passe :</label>
                    <input type="password" id="confirmation" name="confirmation" required>
                    <div class="error" id="error-message" style="display:none;">Les mots de passe ne correspondent pas.</div>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error" id="email-error" style="display:none;"></div>
                </div>
                <div class="form-group">
                    <label for="pays">Pays :</label>
                    <input type="text" id="pays" name="pays" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="number" id="telephone" name="telephone" required>
                </div>
                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select id="statut" name="statut" required>
                        <option value="">Sélectionner...</option>
                        <option value="chomeur">Chômeur</option>
                        <option value="employeur">Employeur</option>
                    </select>
                </div>
                <button type="submit" class="btn">S'inscrire</button>
            </form>
        </div>
    </main>

    <script src="../script/inscription.js"></script>
</body>

</html>