
:: start docker
docker start
:: build -t (tag) .(locatotion of docker file)
docker build -t solomonmuoki/poker .

:: docker run -i (keep stdin open) -t (allocate Pseudoterminal)
:: --rm (remove container on exit) --name(container name)
:: image:tag
docker run -it --rm --name poker docker.io/solomonmuoki/poker
