from skimage.util import img_as_ubyte
from skimage import io
from skimage.morphology import erosion, dilation, opening, closing, white_tophat
from skimage.morphology import black_tophat, skeletonize, convex_hull_image
from skimage.morphology import disk


phantom = img_as_ubyte(io.imread("grisesGalaxia2.jpg", as_grey=True))
selem = disk(6)
eroded = erosion(phantom, selem)
#plot_comparison(phantom, eroded, 'erosion')