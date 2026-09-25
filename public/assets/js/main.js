/**
 * INSTITUTO MOVIMENTO DA ADVOCACIA RENOVADA — MAR
 * Core Application & Mobile-First Interactive JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeaderShrink();
  initMobileDrawer();
  initBrazilMapInteractions();
  initFormValidations();
  initDropdownHoverBuffer();
});

/* 1. Header Sticky Shrink */
function initHeaderShrink() {
  const header = document.querySelector('.site-header');
  if (!header) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
      header.classList.add('shrunk');
    } else {
      header.classList.remove('shrunk');
    }
  });
}

/* 2. Off-Canvas Mobile Navigation Drawer */
function initMobileDrawer() {
  const toggleBtn = document.getElementById('mobile-menu-toggle');
  const closeBtn = document.getElementById('mobile-drawer-close');
  const backdrop = document.getElementById('mobile-drawer-backdrop');
  const drawer = document.getElementById('mobile-drawer');

  if (!toggleBtn || !drawer || !backdrop) return;

  function openDrawer() {
    drawer.classList.add('open');
    backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDrawer() {
    drawer.classList.remove('open');
    backdrop.classList.remove('open');
    document.body.style.overflow = '';
  }

  toggleBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  backdrop.addEventListener('click', closeDrawer);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('open')) {
      closeDrawer();
    }
  });
}

/* 3. Dropdown Hover Grace Period Buffer */
function initDropdownHoverBuffer() {
  const dropdowns = document.querySelectorAll('.nav-dropdown');
  dropdowns.forEach(dropdown => {
    let timeoutId = null;
    const menu = dropdown.querySelector('.nav-dropdown-menu');
    if (!menu) return;

    dropdown.addEventListener('mouseenter', () => {
      clearTimeout(timeoutId);
      menu.style.opacity = '1';
      menu.style.visibility = 'visible';
      menu.style.transform = 'translateY(0)';
    });

    dropdown.addEventListener('mouseleave', () => {
      timeoutId = setTimeout(() => {
        menu.style.opacity = '';
        menu.style.visibility = '';
        menu.style.transform = '';
      }, 180);
    });
  });
}

/* 4. Brazil Map & State Interactions */
function initBrazilMapInteractions() {
  const ufElements = document.querySelectorAll('.map-uf');
  const selectedUfLabel = document.getElementById('selected-uf-name');
  const repCountLabel = document.getElementById('selected-uf-count');

  const defaultUfData = {
    'SP': { name: 'São Paulo', reps: 0 },
    'RJ': { name: 'Rio de Janeiro', reps: 0 },
    'MG': { name: 'Minas Gerais', reps: 0 },
    'BA': { name: 'Bahia', reps: 0 },
    'RS': { name: 'Rio Grande do Sul', reps: 0 },
    'PR': { name: 'Paraná', reps: 0 },
    'PE': { name: 'Pernambuco', reps: 0 },
    'CE': { name: 'Ceará', reps: 0 },
    'DF': { name: 'Distrito Federal', reps: 0 },
    'SC': { name: 'Santa Catarina', reps: 0 },
    'GO': { name: 'Goiás', reps: 0 }
  };

  let ufData = { ...defaultUfData };

  function updateSelectedStateLabel(uf) {
    const stateData = ufData[uf];

    if (selectedUfLabel) {
      selectedUfLabel.innerText = stateData
        ? `${stateData.name} (${uf})`
        : `Estado (${uf})`;
    }

    if (repCountLabel) {
      if (stateData) {
          repCountLabel.innerText = stateData.reps > 0
            ? `${stateData.reps} Representantes Ativos`
            : 'Representação em Expansão';
      } else {
        repCountLabel.innerText = 'Representação em Expansão';
      }

    }
  }

  fetch('/api/v1/representantes/home')
    .then(async (response) => {
      if (!response.ok) throw new Error(`HTTP ${response.status}`);

      const retornoData = await response.json();
      const apiUfData = retornoData && retornoData.original ? retornoData.original : {};

      ufData = {
        ...defaultUfData,
        ...apiUfData
      };

      console.log(ufData, 'matriz atualizada com a API');

      const activeUf = document.querySelector('.map-uf.active')?.getAttribute('data-uf');
      if (activeUf) {
        updateSelectedStateLabel(activeUf);
      }
    })
    .catch(error => console.error('Não foi possível carregar os representantes:', error));

  ufElements.forEach(el => {
    el.addEventListener('click', () => {
      const uf = el.getAttribute('data-uf');
      ufElements.forEach(item => item.classList.remove('active', 'bg-[#C6282D]', 'text-white'));
      el.classList.add('active', 'bg-[#C6282D]', 'text-white');

      updateSelectedStateLabel(uf);
    });
  });
}

/* 5. Form Validation & Toast Feedback */
function initFormValidations() {
  const assocForm = document.getElementById('associado-form');
  if (!assocForm) return;

  assocForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const submitBtn = assocForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin"></i> Enviando...`;
    submitBtn.disabled = true;

    setTimeout(() => {
      submitBtn.innerHTML = `<i class="fa-solid fa-check"></i> Cadastro Enviado com Sucesso!`;
      submitBtn.classList.remove('btn-accent-mar');
      submitBtn.classList.add('bg-green-700', 'text-white');
      
      const successModal = document.getElementById('modal-sucesso');
      if (successModal) {
        successModal.classList.remove('hidden');
        successModal.classList.add('flex');
      }

      assocForm.reset();

      setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        submitBtn.classList.add('btn-accent-mar');
        submitBtn.classList.remove('bg-green-700', 'text-white');
      }, 4000);
    }, 1200);
  });
}

/* Modal Helper Functions */
function closeModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
}
