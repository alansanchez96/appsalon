let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarCita(){mostrarSeccion(),tabs(),botonesPaginador(),paginaAnterior(),paginaSiguiente(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const t=document.querySelector(".selected");t&&t.classList.remove("selected");document.querySelector(`[data-paso="${paso}"]`).classList.add("selected")}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente"),o=document.querySelector("#reservar");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar"),o.classList.add("ocultar"),o.classList.add("displayNone")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(o.classList.add("ocultar"),o.classList.add("displayNone"),e.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginador(),mostrarSeccion())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginador(),mostrarSeccion())})}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",e=>{e.preventDefault(),paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=e.nombre;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${a} `;const r=document.createElement("DIV");r.classList.add("servicios"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(c);document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(t=>t.id===e.id)?(cita.servicios=o.filter(t=>t.id!==e.id),a.classList.remove("seleccionado")):o.some(e=>e.id===t)||(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function idCliente(){const e=document.querySelector("#id").value;cita.id=e}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",cita.fecha="",mostrarAlerta("Fin de semanas no trabajamos","error","#notificaciones")):cita.fecha=e.target.value})}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",e=>{const t=e.target.value,o=t.split(":");o[0]>10&&o[0]<18?cita.hora=t:(cita.hora="",mostrarAlerta("Horario no valido","error","#notificaciones"))})}function mostrarAlerta(e,t,o,a=!0){if(document.querySelector(".alerta"))return;const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta",t);document.querySelector(o).appendChild(n),a&&setTimeout(()=>{n.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenedor-resumen"),t=document.querySelector("#reservar");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return mostrarAlerta("Faltan datos por completar","error",".contenedor-resumen",!1),void t.classList.add("ocultar");const{nombre:o,fecha:a,hora:n,servicios:c}=cita,r=document.createElement("H3");r.textContent="Información de la Cita",e.appendChild(r);const i=document.createElement("DIV");i.classList.add("contenedor-cita");const s=document.createElement("P");s.innerHTML="<span>Nombre:</span> "+o;const d=new Date(a),l=d.getDate()+2,u=d.getMonth(),m=d.getFullYear(),p=new Date(Date.UTC(m,u,l)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric",hour12:!1}),v=document.createElement("P");v.innerHTML="<span>Fecha:</span> "+p;const h=document.createElement("P");h.innerHTML=`<span>Hora:</span> ${n} HS`,i.appendChild(s),i.appendChild(v),i.appendChild(h),e.appendChild(i);const f=document.createElement("H3");f.textContent="Servicios seleccionados",e.appendChild(f),c.forEach(t=>{const{nombre:o,precio:a}=t,n=document.createElement("DIV");n.classList.add("contenedor-servicio");const c=document.createElement("P");c.innerHTML=o;const r=document.createElement("P");r.innerHTML="<span>Precio:</span> $"+a,n.appendChild(c),n.appendChild(r),e.appendChild(n)}),t.classList.remove("ocultar"),t.classList.remove("displayNone"),t.onclick=()=>{reservarCita()}}async function reservarCita(){const{id:e,nombre:t,fecha:o,hora:a,servicios:n}=cita,c=n.map(e=>e.id),r=new FormData;r.append("fecha",o),r.append("hora",a),r.append("usuarioId",e),r.append("servicios",c);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:r});(await t.json()).resultado&&Swal.fire({icon:"success",title:"Cita Agregada",text:"Cita agregada con éxito"}).then(()=>{setTimeout(()=>{window.location.reload()},1e3)})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Estamos trabajando, te mantendremos informado por redes"})}}document.addEventListener("DOMContentLoaded",()=>{iniciarCita()});