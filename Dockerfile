FROM nginx:latest

COPY nginx/nginx.conf /etc/nginx/
COPY src /data/www

CMD [ "nginx", "-g", "daemon off;" ]
