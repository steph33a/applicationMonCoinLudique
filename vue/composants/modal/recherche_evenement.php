
    
    <form style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;" action="">
         <h2 style="font-size: 36px; font-weight: 700; text-align: left; font-family: 'Nunito Sans', sans-serif; margin-bottom: 20px;">
        Recherche Avancée
    </h2>
    
        <!-- Colonne de gauche -->
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <label for="organisateur">Organisateur :</label>
            <input type="text" id="organisateur" name="organisateur" class="formElement">

            <label for="date">Date :</label>
            <input type="date" id="date" name="date" class="formElement">

            <label for="jeux">Jeux/Thèmes :</label>
            <input type="text" id="jeux" name="jeux" class="formElement">
        </div>

        <!-- Colonne de droite -->
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <label for="commune">Commune :</label>
            <input type="text" id="commune" name="commune" class="formElement">

            <label for="typeEvenement">Type d'événement :</label>
            <input type="text" id="typeEvenement" name="typeEvenement" class="formElement">

            <button type="submit" style="margin-top: 30px; background-color: #6EBA46; color: white; font-size: 18px; font-weight: 600; font-family: 'Nunito Sans', sans-serif; padding: 10px 20px; border: none; cursor: pointer;">
                Rechercher
            </button>
        </div>
    </form>
