<div class="bg-gradient-to-r from-black to-blue-900 min-h-screen py-12">
    <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-lg p-8 bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden">
        <h1 class="text-3xl font-bold text-green-500 mb-6 text-center">Connexion</h1>
        
        <form method="POST" action="/login" class="space-y-6">
            <!-- CSRF Token -->
            <?= \JulienLinard\Core\Middleware\CsrfMiddleware::field() ?>
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-500 mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['email']) ? 'border-red-500' : '' ?>"
                    required
                >
                <?php if (isset($errors['email'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-500 mb-2">
                    Mot de passe
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 bg-blue-600 text-white border border-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?= isset($errors['password']) ? 'border-red-500' : '' ?>"
                    required
                >
                <?php if (isset($errors['password'])): ?>
                    <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-800 to-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150"
            >
                Se connecter
            </button>
        </form>
        
        <!-- Link to Register -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Pas encore de compte ? 
                <a href="/register" class="text-blue-600 hover:text-blue-800 font-medium">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
</div>