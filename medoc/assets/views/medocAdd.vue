<template>
    <form>

        <div id="name">
            <label for="name">Nom</label>
            <input type="text" />
        </div>

        <div id="morning">
            <label for="morning">Matin</label>
            <input type="text" />
        </div>

        <div id="afternoon">
            <label for="afternoon">Midi</label>
            <input type="text" />
        </div>
        
        <div id="evening">
            <label for="evening">Soir</label>
            <input type="text" />
        </div>

        <div id="counting">
            <label for="counting">Pour combien de jour</label>
            <input type="text" />
        </div>

        <div id="submit-button">    
          <button @click="addContact">Add Contact</button>
          <button type="submit">Submit</button>
        </div>

    </form>
</template>