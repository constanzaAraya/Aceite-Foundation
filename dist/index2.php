<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Test Foundation</title>
    <meta charset="utf-8">
    <meta name="description" content="Sitio Aceite">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/files/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/vendor/jquery-3.1.1.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
  </head>
  <body>
    <header><a href="" title="Titulo">
        <h1>Titulo del sitio</h1></a>
      <nav>
        <ul class="menu">
          <li class="menu-text">Simple menu</li>
          <li class="active"><a href="">Uno</a></li>
          <li><a href="">Dos</a></li>
          <li><a href="">Tres</a></li>
          <li><a href="">Cuatro</a></li>
        </ul>
      </nav>
    </header>
    <div class="row">
      <div class="small-6 columns">
        <section>
          <h1>Encabezado H1</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
            
          </p>
          <h2>Encabezado H2</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
            
          </p>
          <h3>Encabezado H3</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
            
          </p>
          <h4>Encabezado H4</h4>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
            
          </p>
          <h5>Encabezado H5</h5>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
            
          </p>
        </section>
      </div>
      <div class="small-6 columns">
        <section>
          <h2>Enlaces & Botones</h2><a>Enlace Simple</a><br><a>Enlace Dos Simple</a>
          <div class="row">
            <div class="small-9 columns">
              <ul class="menu">
                <li><a>Enlace Uno</a></li>
                <li><a>Enlace Dos</a></li>
                <li><a>Enlace Tres</a></li>
              </ul>
            </div>
            <div class="small-3 columns">
              <ul class="menu vertical">
                <li><a>Enlace Uno</a></li>
                <li><a>Enlace Dos</a></li>
                <li><a>Enlace Tres</a></li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="small-12 columns"><a class="button button-radius">Color Primario</a><a class="secondary button">Color Secundario</a><a class="disabled button">Deshabilitado</a>
              <button class="success button" type="button">Guardar</button>
              <button class="alert button" type="button">Borrar</button>
              <button class="warning button" type="button">Advertencia</button>
            </div>
            <div class="small-12 columns"><a class="hollow button">Color Primario</a><a class="secondary hollow button">Color Secundario</a><a class="disabled hollow button">Deshabilitado</a>
              <button class="success hollow button" type="button">Guardar</button>
              <button class="alert hollow button" type="button">Borrar</button>
              <button class="warning hollow button" type="button">Advertencia</button>
            </div>
            <div class="small-12 columns"><a class="tiny button">Pequeñísimo</a><a class="small button">Pequeño</a><a class="button">Normal</a><a class="large button">Grande</a></div>
            <div class="small-12 columns"><a class="expanded button">Expandido</a><a class="small expanded button">Pequeño expandido</a></div>
            <div class="small-12 columns">
              <div class="button-group"><a class="button">Grupo</a><a class="button">De</a><a class="button">Botones</a></div>
            </div>
          </div>
        </section>
        <section>
          <div class="slider" data-slider data-initial-start="50"><span class="slider-handle" data-slider-handle role="slider" tabindex="1"></span><span class="slider-fill" data-slider-fill></span>
            <input type="hidden">
          </div>
          <div class="slider" data-slider data-initial-start="50" data-initial-end="70"><span class="slider-handle" data-slider-handle role="slider" tabindex="1"></span><span class="slider-fill" data-slider-fill></span><span class="slider-handle" data-slider-handle role="slider" tabindex="1"></span>
            <input type="hidden">
            <input type="hidden">
          </div>
          <div class="slider disabled" data-slider data-initial-start="50"><span class="slider-handle" data-slider-handle role="slider" tabindex="1"></span><span class="slider-fill" data-slider-fill></span>
            <input type="hidden">
          </div>
        </section>
        <section>
          <div class="switch">
            <input class="switch-input" id="switch1" type="checkbox" name="switch1">
            <label class="switch-paddle" for="switch1"><span class="show-for-sr">Label</span></label>
          </div>
          <div class="switch">
            <input class="switch-input" id="switch2" type="radio" name="switchGroup1">
            <label class="switch-paddle" for="switch2"><span class="show-for-sr">Label</span></label>
          </div>
          <div class="switch">
            <input class="switch-input" id="switch4" type="radio" name="switchGroup1" checked>
            <label class="switch-paddle" for="switch4"><span class="show-for-sr">Label</span></label>
          </div>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="small-6 columns">
        <section>
          <h2>Listas & Tabs</h2>
          <ul class="tabs" id="example-tabs" data-tabs>
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Lista No Ordenada</a></li>
            <li class="tabs-title"><a href="#panel2">Lista Ordenada</a></li>
            <li class="tabs-title"><a href="#panel3">Lista Definición</a></li>
          </ul>
          <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">
              <ul>
                <li>Primero</li>
                <li>Tercero</li>
                <li>Segundo</li>
              </ul>
            </div>
            <div class="tabs-panel" id="panel2">
              <ol>
                <li>Primero</li>
                <li>Segundo</li>
                <li>Tercero</li>
              </ol>
            </div>
            <div class="tabs-panel" id="panel3">
              <dl>
                <dt>Metropolitana</dt>
                <dd>Santiago</dd>
                <dt>Libertador Bernando</dt>
                <dd>Rancagua</dd>
              </dl>
            </div>
          </div>
        </section>
        <section>
          <h2>Tablas</h2>
          <table>
            <thead>
              <tr>
                <th>Encabezado</th>
                <th>Encabezado</th>
                <th>Encabezado</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Dato 1.1</td>
                <td>Dato 1.2</td>
                <td>Dato 1.3</td>
              </tr>
              <tr>
                <td>Dato 2.1</td>
                <td>Dato 2.2</td>
                <td>Dato 2.3</td>
              </tr>
              <tr>
                <td>Dato 3.1</td>
                <td>Dato 3.2</td>
                <td>Dato 3.3</td>
              </tr>
            </tbody>
          </table>
        </section>
        <section>
          <h2>Paneles (Callout)</h2>
          <div class="callout">
            <h3>.callout</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. 
            </p><a>Enlace</a>
          </div>
          <div class="callout primary">
            <h3>.callout.primary</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. 
            </p><a>Enlace</a>
          </div>
          <div class="callout small">
            <h3>.callout.small</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. 
            </p><a>Enlace</a>
          </div>
          <div class="callout warning large">
            <h3>.callout.large</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. 
            </p><a>Enlace</a>
          </div>
        </section>
      </div>
      <div class="small-6 columns">
        <section>
          <h2>Forms</h2>
          <form>
            <div class="row">
              <div class="small-6 columns">
                <label>Input Label
                  <input type="text" placeholder=".small-6.columns">
                </label>
                <label>Cu&aacute;nto?
                  <input type="number" value="50">
                </label>
                <label>Select
                  <select>
                    <option value="Uno">Uno</option>
                    <option value="Dos">Dos</option>
                    <option value="Tres">Tres</option>
                  </select>
                </label>
                <label>Password
                  <input type="password" aria-describedby="passHelper">
                </label>
                <p class="help-text" id="passHelper">Tu password debe ...</p>
                <label class="button" for="fileUpload">Subir archivo</label>
                <input class="show-for-sr" id="fileUpload" type="file">
              </div>
              <div class="small-6 columns">
                <label>Input Label
                  <input type="text" placeholder=".small-6.columns">
                </label>
                <label>
                  <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." rows="5"></textarea>
                </label>
                <div class="input-group"><span class="input-group-label"><i class="fa fa-eur" aria-hidden="true"></i></span>
                  <input class="input-group-field" type="number">
                  <div class="input-group-button">
                    <input class="button" type="submit" value="Enviar">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="small-12 columns">
                <fieldset>
                  <legend>Una Opcion</legend>
                  <input id="pikachu" type="radio" name="pokemon" value="pikachu" required>
                  <label for="pikachu">Pikachu</label>
                  <input id="squirtle" type="radio" name="pokemon" value="squirtle">
                  <label for="squirtle">Squirtle</label>
                  <input id="bulbasaur" type="radio" name="pokemon" value="bulbasaur">
                  <label for="bulbasaur">Bulbasaur</label>
                </fieldset>
                <fieldset>
                  <legend>Varias Opciones</legend>
                  <input id="check1" type="checkbox">
                  <label for="check1">Check1</label>
                  <input id="check2" type="checkbox">
                  <label for="check2">Check2</label>
                  <input id="check3" type="checkbox">
                  <label for="check3">Check3</label>
                </fieldset>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>