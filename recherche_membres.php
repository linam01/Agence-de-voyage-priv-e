<form  method="post">
    <label>Pseudo: <input type="text" name="pseudo"></label><br>
    <label>Trier par :
        <select name="tri">
            <option value="pseudo">pseudo</option>
        </select>
    </label><br>
    En ordre: <label>Croissant <input type="radio" name="ordre" value="ASC" checked="checked"></label> <label>Décroissant <input type="radio" name="ordre" value="DESC"></label><br>
    <button type="submit">Rechercher</button>
</form>