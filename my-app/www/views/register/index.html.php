<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-white to-purple-500 py-12 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                    <h2 class="text-3xl text-white font-bold">Créer un compte</h2>
                    <p class="text-indigo-100 mt-2">Rejoignez-nous</p>
                </div>
                <form class="p-6 space-y-6" method="post" action="/register">
                    <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                    <?php if (isset($error)): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex">
                            <p class="text-sm text-red-700"><?= $error ?></p>
                        </div>
                    <?php endif ?>
                    <div class="flex space-x-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="prenom">Votre Prénom</label>
                            <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400" type="text" name="firstname" placeholder="Clement" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="nom">Votre Nom</label>
                            <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400" type="text" name="lastname" placeholder="Faure" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Votre email</label>
                        <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400" type="email" name="email" placeholder="votre@email.com" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">Votre password</label>
                        <input class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none text-gray-900 placeholder-gray-400" type="password" name="password" placeholder="*********" required>
                    </div>
                    <div class="w-full px-6 py-3 border bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl duration-200 transition-all transform hover:-translate-y-0.5">
                        <button type="submit">S'inscrire</button>
                    </div>
                    <div class="text-center pt-4 border_t border-gray-200">
                        <p class="text-sm text-gray-600">deja un compte ?<a class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors" href="/login"> Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>