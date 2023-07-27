<section id="home">
       <div class="recherche_pays">
	<form action="" class="formulaire">
          <div>
            <label>Pays
            <input type="text" id="id_pays" name="pays" placeholder="Entrez un Pays" required="required" ></label>
          </div>
          <div>
            <label>Date de départ
            <input type="date" id="id_ville" name="ville" placeholder="Entrez une date de départ" required required="required"></label>
          </div>
         <div>
          <input type="button" value="Recherche" onclick=" verifierDate() && verifierPays()  " id="id_voir" name="voir" class="button_recherche">
    </div>
     </form>
      </div>
       <p id="phrase" class="phrase" >La valeur entrée n&apos;est pas valide. Veuillez réessayer.</p>
        <p id="p_date" class="phrase" >La date entrée n&apos;est pas valide. Veuillez réessayer.</p>
    </section>