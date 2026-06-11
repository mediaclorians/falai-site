"""
Composição final do hero.jpg
  1. Canvas preto 1000x950
  2. Echo (gritando, 80% brilho) — camada inferior, posição direita
  3. Modelo sorrindo — camada superior, x=0 (≈30px da coluna de texto)
  4. Ícone camiseta — topo absoluto, no peito da modelo
"""
from PIL import Image, ImageEnhance

BASE   = "C:/Users/webmu/Claude/Projects/FalaiSite"
FRENTE = f"{BASE}/material/novo/Adobe Express 2026-05-16 19.20.04.png"
FUNDO  = f"{BASE}/material/novo/Adobe Express 2026-05-16 19.20.36.png"
ICON   = f"{BASE}/site/assets/img/tshirt-white.png"
OUT    = f"{BASE}/site/assets/img/hero.jpg"

W, H = 1000, 950
canvas = Image.new("RGB", (W, H), (0, 0, 0))

# ── 1. Echo (inferior): h=730, posição direita separada da modelo ─────────
echo_src = Image.open(FUNDO).convert("RGBA")
eh = 730
ew = round(echo_src.width * eh / echo_src.height)
echo = echo_src.resize((ew, eh), Image.LANCZOS)
echo = ImageEnhance.Brightness(echo).enhance(0.65)
ex, ey = 359, (H - eh) // 2          # corpo visível a partir de canvas x≈572
canvas.paste(echo, (ex, ey), echo)

# ── 2. Modelo sorrindo (superior): h=885, começando na borda esquerda ────
frente_src = Image.open(FRENTE).convert("RGBA")
fh = 885
fw = round(frente_src.width * fh / frente_src.height)
frente = frente_src.resize((fw, fh), Image.LANCZOS)
fx, fy = -265, H - fh                # corpo começa em canvas x≈3 (≈30px do texto)
canvas.paste(frente, (fx, fy), frente)

# ── 3. Ícone camiseta: peito do echo, lado direito ────────────────────────
icon = Image.open(ICON).convert("RGBA")
# Centro ≈ canvas (880, 450) — sobre a camiseta do echo, à direita da modelo
ix = 880 - icon.width  // 2          # 815
iy = 450 - icon.height // 2          # 385
canvas.paste(icon, (ix, iy), icon)

canvas.save(OUT, "JPEG", quality=92, subsampling=0)
print(f"hero.jpg salvo: {W}x{H}")
